@if ($errors->any())

    @foreach ($errors->all() as $error)
        <p style="color: red;margin:0 0 5px 0;padding:0">{{ $error }} !!!</p>
    @endforeach

@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
