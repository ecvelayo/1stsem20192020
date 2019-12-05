@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                
                {{-- ACCESSING THE DATA OF CURRENT USER --}}
                {{-- {{ Auth::user()->user_id }} --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- <a href="{{ url('/admin') }}">Admin Login</a> --}}
                    <a href="{{ url('/admin/home') }}">Admin Homepage</a>
                    <a href="{{ route('#') }}">Register Employee</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
