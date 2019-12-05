@extends('cashier.appLogin')

@section('content')
    <div class="mx-auto border border-light bg-white pr-1" style="margin-top: 170px; width: 470px">
        <div class="bg-info">
            <h3 class="p-2 text-white">Cashier</h3>
        </div>
        <label class="ml-2 pt-2 pl-2 pr-2 pt-4">Username:</label><br>
        <input type="text" name="username" class="ml-3 p-2" style="width: 440px;"><br>
        <label class="ml-2 pt-2 pl-2 pr-2 ">Password:</label><br>
        <input type="password" name="password" class="ml-3 p-2" style="width: 440px;">
        <br>
        <center>
        <input type="submit" name="login" value="Login" class="btn btn-info mt-4 mb-3">
        </center>
    </div>
@endsection