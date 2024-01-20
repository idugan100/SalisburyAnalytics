@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="card-body alert alert-info">
                    <a href="/">To home page</a>
                </div>
            </div>
            <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('reviews.approved')}}">Approved</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="{{route('reviews.processing')}}">Processing</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('reviews.rejected')}}">Rejected</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  " href="{{route('usage.index')}}">Usage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('actions.index')}}">Actions</a>
                        </li>
                        
                    </ul>
                <div class="card-header">Actions</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row m-1">

                            <button class="btn btn-primary col-4" 
                                hx-get="/actions/recalculate-professors" 
                                hx-target="#professor-results" 
                                hx-indicator="#professor-spinner"
                            >
                                Recalculate Professor Statistics
                            </button>
                            <div class="spinner-border col-2 mx-2 text-primary htmx-indicator" id ="professor-spinner" role="status"></div>
                            <div class="col-sm" id="professor-results"></div>

                        </div>
                        <div class="row m-1">
                                <button class="btn btn-primary col-4" 
                                    hx-get="/actions/recalculate-courses" 
                                    hx-target="#course-results"
                                    hx-indicator="#course-spinner"
                                >
                                    Recalculate Course Statistics
                                </button>
                                <div class="spinner-border col-2 mx-2 text-primary htmx-indicator" id ="course-spinner" role="status"></div>
                                <div class="col-sm" id="course-results"></div>
                          </div>
                          <div hx-get="{{route("actions.jobs")}}" hx-trigger="every 2s, load" hx-target="#jobs"></div>
                          <div id="jobs"></div>

                      </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
