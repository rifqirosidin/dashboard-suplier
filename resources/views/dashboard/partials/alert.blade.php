@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
    </div>
{{--<script>--}}
{{--    Swal.fire(--}}
{{--        'Good job!',--}}
{{--        'You clicked the button!',--}}
{{--        'success'--}}
{{--    )--}}
{{--</script>--}}

@endif
