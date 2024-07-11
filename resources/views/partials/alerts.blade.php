@if(session('success'))
    <div class="alert alert-success mt-3 w-75 m-auto">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger mt-3 w-75 m-auto">
        {{ session('error') }}
    </div>
@endif
