@extends('layouts.employee')
@section('content')
@include('inc.message')
@include('cashier.table')
<a href="{{ route('cashier.export') }}" class="btn btn-sm btn-primary">Export</a>
@endsection

