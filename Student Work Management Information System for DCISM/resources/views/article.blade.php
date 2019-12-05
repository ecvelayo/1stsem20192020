@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
        <div class="col-md-12  py-5" style="background:url({{ asset('img/books.jpg') }}) top center;background-size:cover;height:400px">
            <div class="text-center">
            <img src="{{ asset('img/logo_clean.png') }}" class="img-fluid mx-auto" alt="">
            </div>
            <form action="{{ url('/') }}" method="get">
                <div class="row">
                
                    <div class="col-8 offset-2 my-5">
                        <div class="input-group">
                            <select class="form-control form-control-lg" id="select2-ajax-main">
                               <option value="{{ $project->id }}">{{ $project->title }}</option>   
                            </select>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 offset-sm-0">
            <div class="card">
                <div class="card-body border-bottom">
                        <dl class="row">
                            <dt class="col-md-2">Title</dt>
                            <dd class="col-md-10">
                                <h3 class="card-title mb-0" style="font-size:1.2rem">
                                    <a class="text-decoration-none" href="{{ url("view/{$project->id}") }}" >{{ $project->title }}</a>
                                </h3>
                            </dd>
                            <dt class="col-md-2">Adviser</dt>
                            <dd class="col-md-10">
                                <span class="badge badge-secondary text-white mr-1">
                                    <i class="fas fa-user fa-fw"></i>
                                    {!! $project->adviser->fullname !!}
                                </span>
                            </dd>
                            <dt class="col-md-2">Authors</dt>
                            <dd class="col-md-10">
                                <span class="badge badge-secondary text-white mr-1">
                                    <i class="fas fa-user fa-fw"></i>
                                    {!! $project->authors->pluck('fullname')->implode('</span><span class="badge badge-secondary mr-1 text-white"><i class="fas fa-user fa-fw"></i>') !!}
                                </span>
                            </dd>
                            <dt class="col-md-2">Chair Panel</dt>
                            <dd class="col-md-10">
                                <span class="badge badge-secondary text-white mr-1">
                                    <i class="fas fa-user fa-fw"></i>
                                    {!! $project->chair_panel->fullname !!}
                                </span>
                            </dd>
                            <dt class="col-md-2">Panel Members</dt>
                            <dd class="col-md-10">
                                <span class="badge badge-secondary text-white mr-1">
                                    <i class="fas fa-user fa-fw"></i>
                                    {!! $project->panel->pluck('fullname')->implode('</span><span class="badge badge-secondary mr-1 text-white"><i class="fas fa-user fa-fw"></i>') !!}
                                </span>
                            </dd>
                            <dt class="col-md-2">Abstract</dt>
                            <dd class="col-md-10">
                                {{ $project->abstract }}
                            </dd>
                            <dt class="col-md-2">Description:</dt>
                            <dd class="col-md-10"></dd>
                            <dt class="col-md-2">Call Number</dt>
                            <dd class="col-md-10">
                                {{ $project->call_number }}
                            </dd>
                            <dt class="col-md-2">Area</dt>
                            <dd class="col-md-10">
                                {{ $project->area->name }}
                            </dd>
                            <dt class="col-md-2">Semester</dt>
                            <dd class="col-md-10">
                                {{ $project->semester == 1 ? '1st' : ($project->semester == 2 ? '2nd' : 'Summer') }}
                            </dd>
                            <dt class="col-md-2">Academic Year</dt>
                            <dd class="col-md-10">
                                {{ $project->academic_year }}
                            </dd>
                            <dt class="col-md-2">Work Type</dt>
                            <dd class="col-md-10">
                                {{ $project->work_type }}
                            </dd>
                            <dt class="col-md-2">Keywords</dt>
                            <dd class="col-md-10">
                                <span class="badge badge-pill badge-info text-white mr-1">
                                    {!! $project->keywords_collection->implode('</span><span class="badge badge-pill badge-info mr-1 text-white">') !!}
                                </span>
                            </dd>
                        </dl>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body mt-0">
                    <h4 class="card-title">Preview</h4>
                    <div class="row">
                    @forelse($project->getPreviewsFilePath() as $preview)
                        <div class="col-6 text-center">
                            <a data-fancybox="gallery" href="{{ $preview }}">
                                <img class="img-fluid border rounded mx-auto" src="{{ $preview }}" alt="{{ $project->title }} preview page {{ $loop->iteration }}" >
                            </a>
                        </div>
                    @empty
                        No resource
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#select2-ajax-main').select2({
            theme: "bootstrap4",
            ajax: {
                url: "{{ url('projects/search') }}",
                data: function (params) {
                    return {search: params.term}
                },
            }
        }).on('select2:select', function () {
            if($(this).val()){
                window.location.href = "{{ url('view') }}/" + $(this).val()
            }
        });
    })
</script>
@endpush    