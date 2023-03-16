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
                <div class="card-header">Pending Reviews</div>
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
                                <th scope="row">{{$review->id}}</th>
                                <td>{{$review->professor->firstName . " " . $review->professor->lastName}}</td>
                                <th scope="row">{{$review->course->departmentCode . "-" . $review->course->courseNumber}}</th>
                                <td>{{$review->response}}</td>
                                <td>
                                    <a class="btn btn-success btn-sm m-2 "href="">Approve</a>
                                    <a class="btn btn-danger btn-sm m-2"href="">Reject</a>

                                </td>
                              </tr>
                            @endforeach
                            <div>
                                {{$reviews->links()}}

                            </div>
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
