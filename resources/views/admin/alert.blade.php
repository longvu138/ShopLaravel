
@if ($errors->any())
    <div class="alert alert-danger">
       
            @foreach ($errors->all() as $error)
                <p style="color: red;margin:0;padding:0" >{{ $error }} !!!</p>
            @endforeach
        
    </div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger">
    {{Session::get('error')}}
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success">
    {{Session::get('success')}}
</div>
@endif