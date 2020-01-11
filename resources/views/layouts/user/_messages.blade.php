@if(session()->has('success'))
<script>
    window.onload = function () {
        toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        })
    }
</script>
@endif
