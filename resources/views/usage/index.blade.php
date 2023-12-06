@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Total Usage</div>
                <div class="card-body">
                    <div>{{"total views: " . $total_bot_views + $total_human_views}}</div>
                    <div>{{"total bot views: " . $total_bot_views}}</div>
                    <div>{{"total human views: " . $total_human_views}}</div>
                </div>

            </div>
            <div class="card">
              
                
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
                        <a class="nav-link " href="{{route('reviews.rejected')}}">Rejected</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active " href="{{route('usage.index')}}">Usage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{route('actions.index')}}">Actions</a>
                        </li>
                        
                    </ul>
                <div class="card-header">Usage</div>
                <div class="card-body">
                    <table class="table ">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total </th>
                            <th scope="col">Course</th>
                            <th scope="col">Review</th>
                            <th scope="col">Professor</th>
                            <th scope="col">About</th>
                            <th scope="col">Reports</th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($usage_logs as $usage_log)
                            <tr>
                                <th  scope="row">{{$usage_log->id}}</th>
                                <td>
                                    {{$usage_log->created_at}}
                                </td>
                                <td>
                                    <div class="bg-success bg-opacity-25 px-2">
                                        <a href="{{route("usage.details",$usage_log)}}">
                                            {{$usage_log->course_views+$usage_log->professor_views+$usage_log->review_views+$usage_log->about_views+$usage_log->report_views}}
                                        </a>
                                    </div>
                                    <div class="bg-danger bg-opacity-25 px-2">{{$usage_log->course_views_bot+$usage_log->professor_views_bot+$usage_log->review_views_bot+$usage_log->about_views_bot+$usage_log->report_views_bot}}</div>
                                </td>
                                <td>
                                    <div class="bg-success bg-opacity-25 px-2"> {{$usage_log->course_views}}</div>
                                    <div class="bg-danger bg-opacity-25 px-2">{{$usage_log->course_views_bot}}</div>
                                </td>
                                <td>
                                    <div class="bg-success bg-opacity-25 px-2"> {{$usage_log->review_views}}</div>
                                    <div class="bg-danger bg-opacity-25 px-2">{{$usage_log->review_views_bot}}</div> 
                                </td>
                                <td>
                                    <div class="bg-success bg-opacity-25 px-2"> {{$usage_log->professor_views}}</div>
                                    <div class="bg-danger bg-opacity-25 px-2">{{$usage_log->professor_views_bot}}</div>
                                </td>
                                <td>
                                    <div class="bg-success bg-opacity-25 px-2"> {{$usage_log->about_views}}</div>
                                    <div class="bg-danger bg-opacity-25 px-2">{{$usage_log->about_views_bot}}</div>
                                </td>
                                <td>
                                    <div class="bg-success bg-opacity-25 px-2"> {{$usage_log->report_views}}</div>
                                    <div class="bg-danger bg-opacity-25 px-2">{{$usage_log->report_views_bot}}</div>
                                </td>
                                
                                
                              </tr>
                            @endforeach
                           
                          
                        </tbody>
                      </table>
                    <div>
                        @if (!$usage_logs->onFirstPage())
                            <a href="{{$usage_logs->previousPageUrl()}}" class="m-2">Previous</a>
                        @endif
                        @if($usage_logs->hasMorePages())
                            <a href="{{$usage_logs->nextPageUrl()}}" class="m-2">Next </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection