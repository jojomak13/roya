@if(session()->has('status'))
<script>
    window.onload = function () {
        toast.fire({
            icon: 'info',
            title: "{{ session('status') }}",
            timer: 3000,
            timerProgressBar: true
        })
    }
</script>
@endif
