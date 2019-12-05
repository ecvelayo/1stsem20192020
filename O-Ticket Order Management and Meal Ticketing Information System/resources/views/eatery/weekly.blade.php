@extends('layouts.eatery')
@section('content')
@include('eatery.table')
<a href="{{ route('eatery.export') }}" class="btn btn-primary">Export</a>
@endsection