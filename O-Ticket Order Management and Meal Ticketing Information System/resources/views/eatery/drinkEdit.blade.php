@extends('layouts.eatery')
@section('content')
    <div class="container">
    <br>
        <h4>Redeem Request List</h4>
    <br>
    <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col" style="width: 200px" >Drink Name</th>
                    <th scope="col" style="width: 200px" >Availability</th>
                    <th scope="col" >... </th>
                </tr>
            </thead>
            <tbody>
     
	    @foreach($drink as $d)
        <tr>
            <td>{{ $d->name }}</td>
            @if($d->status == 1)
            <td>Available</td>
            <td><a class="btn btn-danger" href="{{ url('/eatery/drinkChange/'.$d->drink_id) }}"> Not available </a></td>
            @elseif($d->status == 0)
            <td>Not Available</td>
            <td><a class="btn btn-primary" href="{{ url('/eatery/drinkChange/'.$d->drink_id) }}"> Available </a></td>
            @endif
            </tr>
        @endforeach
            </tbody>
        </table>

        

    </div>

@endsection