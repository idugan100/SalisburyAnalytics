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
                        <a class="nav-link active" href="{{route('reviews.processing')}}">Processing</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('reviews.rejected')}}">Rejected</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('usage.index')}}">Usage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('actions.index')}}">Actions</a>
                        </li>
                        
                    </ul>
                <div class="card-header">Processing Reviews</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Professor</th>
                            <th scope="col">Course</th>
                            <th scope="col">Review</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                            <tr>
                                <th class="table-active" scope="row">{{$review->id}}</th>
                                <td class="table-active">{{$review->professor->firstName . " " . $review->professor->lastName}}</td>
                                <td class="table-active" scope="row">{{$review->course->departmentCode . "-" . $review->course->courseNumber}}</th>
                                <td class="table-active">{{$review->response}}</td>
                                <td class="table-active">
                                    <a class="btn btn-success btn-sm m-2 "href="{{route("review.approve",$review)}}">Approve</a>
                                    <a class="btn btn-danger btn-sm m-2"href="{{route("review.reject",$review)}}">Reject</a>

                                </td>
                              </tr>
                            @endforeach                         
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
