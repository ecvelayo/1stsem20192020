@if(count($errors) > 0)
    @foreach ($errors->all() as $item)
    <center>
        <div class="alert alert-danger col-md-5 text-center" style="margin-top:70px;">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{$error}}
        </div>
    </center>
    @endforeach
@endif

@if (session('success'))
<center>
    <div class="alert alert-success col-md-5 text-center" style="margin-top:70px;">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{session('success')}}
    </div>
</center>
@endif

@if (session('error'))
<center>
    <div class="alert alert-danger col-md-5 text-center" style="margin-top:70px;">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{session('error')}}
    </div>
</center>
@endif