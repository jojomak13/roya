@if(session()->has('success'))
<script>
    toast.fire({
        icon: 'success',
        title: "{{ session('success') }}"
    })
</script>
@endif

@if(session()->has('warning'))
<script>
    toast.fire({
        icon: 'warning',
        title: "{{ session('warning') }}"
    })
</script>
@endif

@if(session()->has('status'))
<script>
    toast.fire({
        icon: 'info',
        title: "{{ session('status') }}"
    })
</script>
@endif
