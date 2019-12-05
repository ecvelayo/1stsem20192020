@extends('layouts.marketing')
@section('content')
<br>
    <h1>Patron's Weekly Report</h1>
    <a href="{{ route('marketing.export') }}" class="btn btn-primary">Export</a>
@include('eatery.table') 
@endsection