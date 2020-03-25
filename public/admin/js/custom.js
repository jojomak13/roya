"use strict";

window.toast = Swal.mixin({
    toast: true,
    position: "top",
    showConfirmButton: false,
    timer: 2000
});

$(window).ready(function() {
    // custom Method for delete button
    $(".delete-btn").click(function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.value)
                $(this)
                    .children("form")
                    .submit();
        });
    });

    // Image Preview
    $("#uploader").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#preview").attr("src", e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });

    $('input[type="file"]').on('change', function(){
        $('button[type="submit"]').attr('disabled', false)

        Array.from(this.files).forEach(file => {
            let size = Math.ceil(file.size / 1024);
            if(size >= 3500){
                $(this).addClass('is-invalid');
                $('button[type="submit"]').attr('disabled', true)
            }
        })
    })
});

function printBarCode(base64ocde) {
    printJS({
        printable: `data:image/png;base64,${base64ocde}`,
        type: "image"
        // imageStyle: 'width:100%;'
    });
}
