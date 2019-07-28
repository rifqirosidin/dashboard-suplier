@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
    </div>
@elseif(session()->has('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('failed') }}
    </div>
@endif
