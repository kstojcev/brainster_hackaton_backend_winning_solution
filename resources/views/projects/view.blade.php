@extends('layouts.app')

@section('title', 'VA Dashboard | Project')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12">
            <div class="p-6 bg-white border-b border-gray-200 row flex-row">
                <div class="col-md-6 d-flex flex-col fs-5">
                    {{-- <p class="display-6 mb-0 pb-0">Project: {{$project->title}}</p> --}}
                    
                    <div class="d-flex flex-row align-items-end mb-2">
                        <div class="col-2">
                            <p class="fw-bold mb-1 p-0">Title:</p>
                        </div>
                        <div class="col fs-2">
                                <p class="m-0 p-0 ms-3">{{$project->title}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <p class="fw-bold">Services:</p>
                        </div>
                        <div class="col">
                            @foreach ($project->services as $service)
                            <span>- {{$service->title}}</span>
                            <br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <p class="text fs-5 mt-2 float-right">{{ $project->location . ' | ' . $project->date}}</p>
            </div>
            </div>
        </div>
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12 container">
            <div class="p-6 bg-white border-b border-gray-200 row">
                @foreach ($project->images as $image)
                    @if ($loop->first)
                        <div class="col-md-8">
                            <img src="{{ asset($image->images) }}" alt="">
                        </div>
                        <div class="col-md-3">
                    @else
                            <img src="{{ asset($image->images) }}" class="mb-5" alt="">
                            @endif
                            @endforeach
                        </div>
                <h3 class="mt-4">{{ $project->description }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection