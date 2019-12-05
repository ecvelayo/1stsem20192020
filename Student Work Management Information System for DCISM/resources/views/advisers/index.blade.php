@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(session('message'))
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="card-header d-flex align-items-center justify-content-between">
                    List of all advisers
                    <form class="form-inline" method="get">
                    <div class="form-group ml-2">
                        <label class="mr-2">Teacher</label>
                        <input type="text" name="adviser" class="form-control" value="{{ request('adviser') }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Search</button>
                    </form>
                    <a class="btn btn-success px-3" href="{{ url('advisers/create') }}">Create new teacher</a>
                </div>

                <div class="card-body p-0">
                    <table class="table mb-0 table-hover table-striped">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th></th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>M.I</th>
                                <th>Educational Attainment</th>
                                <th>Role</th>
                                <th>Username</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($advisers as $adviser)
                            <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $adviser->lastname }}</td>
                                    <td>{{ $adviser->firstname }}</td>
                                    <td>{{ $adviser->middle_initial }}</td>
                                    <td>{{ $adviser->title }}</td>
                                    <td>{{ $adviser->user_role }}</td>
                                    <td>{{ $adviser->username }}</td>
                                    <td> <a class="btn btn-success px-3" href="{{ url("advisers/{$adviser->id}/edit") }}" class="mr-2">Edit</a></td>
                                        <td> 
                                            @if(count($adviser->handledProjects) < 1 && count($adviser->chairPaneledProjects) < 1 && count($adviser->paneledProjects) < 1)
                                            <form class="delete-form" action="{{ url("advisers/{$adviser->id}/delete") }}">
                                            {{ csrf_field() }}
                                            <a class="btn btn-danger px-3" href="#" onclick="confirmDelete(this)" class="text-danger">Delete
                                            </a>
                                        </form>
                                            @endif
                                        </td>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
   <script>
       function confirmDelete(el) {
        var x = confirm("Are you sure you want to delete?");
            if (x){
                $(el).closest(".delete-form").submit();
            }
            else {
                return;
            }
       }
   </script>
@endpush
