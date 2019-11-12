'use strict'

window.toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 2000
})

$(window).ready(function () {

    // custom Method for delete button
    $('.delete-btn').click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value)
                $(this).children('form').submit();
        })
    })

})
