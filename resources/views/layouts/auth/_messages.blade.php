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

@if (session('resent'))
<script>
    window.onload = function () {
        toast.fire({
            icon: 'info',
            title: "{{ __('user.verifyEmailSent') }}",
            timer: 3000,
            timerProgressBar: true
        })
    }
</script>
@endif
