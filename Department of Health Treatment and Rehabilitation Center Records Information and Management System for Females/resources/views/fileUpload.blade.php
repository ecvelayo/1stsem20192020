@extends('main')
@section('content')
    
     <style>

        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }

        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }

        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}

    </style>

<div class="container">
    <div class="card">

      <div class="card-header">

        <h2>Laravel 5.6 - File upload with progress bar - ItSolutionStuff.com</h2>

      </div>

      <div class="card-body">

            <form method="POST" action="{{ route('fileUploadPost') }}" enctype="multipart/form-data">

                @csrf

                <div class="form-group">

                    <input name="file" id="poster" type="file" class="form-control"><br/>

                    <div class="progress">

                        <div class="bar"></div >

                        <div class="percent">0%</div >

                    </div>

                    <input type="submit"  value="Submit" class="btn btn-success">

                </div>

            </form>    

      </div>

    </div>

</div>



@endsection