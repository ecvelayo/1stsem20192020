@extends('main')
@section('content')

<div class="container">
	<h1 class="page-header text-center">Laravel File Upload</h1>
	@include('flash::message')
	<div class="row">
		<div class="col-md-4">
			<div class="well">
				<h2 class="text-center">Upload Form</h2>
				<form method="POST" action="{{ route('upload.file') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="file" name="file[]" multiple><br>
					<button type="submit" class="btn btn-primary">Upload</button>
				</form>
			</div>
			<div style="margin-top:20px;">
			@if(count($errors) > 0)
				@foreach($errors->all() as $error)
					<div class="alert alert-danger text-center">
						{{$error}}
					</div>
				@endforeach
			@endif

			@if(session('success'))
				<div class="alert alert-success text-center">
					{{session('success')}}
				</div>
			@endif
			</div>
		</div>
		<div class="col-md-8">
			<h2>Files Table</h2>
			<div class="table-responsive scrollAble2">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
					<thead>
						<tr>
							<th>File Name</th>
							<th>File Size</th>
							<th>Date Uploaded</th>
							<th>File Location</th>
						</tr>
					</thead>
					<tbody>
						@if(count($files) > 0)
							@foreach($files as $file)
								<tr>
									<td>{{ $file->name }}</td>
									<td> 
										@if($file->size < 1000)
											{{ number_format($file->size,2) }} bytes
										@elseif($file->size >= 1000000)
											{{ number_format($file->size/1000000,2) }} mb
										@else
											{{ number_format($file->size/1000,2) }} kb
										@endif
									</td>
									<td>{{ date('M d, Y h:i A', strtotime($file->created_at)) }}</td>
									<td><a href="{{ $file->location }}">{{ $file->location }}</a></td>
								</tr>
								<!--<img src='storage/upload/{{$file->name}}' name="{{$file->name}}" class="thumbnail">-->
							@endforeach
						@else
							<tr>
								<td colspan="4" class="text-center">No Table Data</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
			
			
			
		</div>
	</div>
</div>

@endsection


