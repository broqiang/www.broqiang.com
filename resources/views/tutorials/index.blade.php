@extends('layouts.app')

@section('title', '教程列表')

@section('content')
<div class="container">
    <div class="row">
        @if(count($tutorials))
            @foreach($tutorials as $tutorial)
                @if($tutorial->auth) 
                    <div class="col-md-4 my-3">
                        <div class="card text-muted">
                            <a href="{{ route('tutorials.show', $tutorial->slug) }}">
                                <img class="card-img-top" src="{{ $tutorial->title_page }}" alt="{{ $tutorial->title_page }}">
                            </a>
                            <div class="card-body">
                                <a class="text-muted" href="{{ route('tutorials.show', $tutorial->slug) }}">
                                    <div class="card-title">
                                        <h3>{{ $tutorial->title }} </h3>
                                    </div>
                                </a>
                                <div class="card-text">
                                    <span title="创建时间：{{ $tutorial->created_at }}">
                                        <i class="fa fa-clock-o text-primary"></i> {{ $tutorial->created_at->diffForHumans() }}
                                    </span>
                                    <span class="mx-3" title="更新时间：{{ $tutorial->updated_at }}">
                                        <i class="fa fa-clock-o text-success"></i> {{ $tutorial->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                                <hr>
                                <div class="card-text">
                                    {!! $tutorial->stringToMarkdown($tutorial->description) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @can('isMember', $tutorial)
                        <div class="col-md-4 my-3">
                            <div class="card text-muted">
                                <a href="{{ route('tutorials.show', $tutorial->slug) }}">
                                    <img class="card-img-top" src="{{ $tutorial->title_page }}" alt="{{ $tutorial->title_page }}">
                                </a>
                                <div class="card-body">
                                    <a class="text-muted" href="{{ route('tutorials.show', $tutorial->slug) }}">
                                        <div class="card-title">
                                            <h3>{{ $tutorial->title }} </h3>
                                        </div>
                                    </a>
                                    <div class="card-text">
                                        <span title="创建时间：{{ $tutorial->created_at }}">
                                            <i class="fa fa-clock-o text-primary"></i> {{ $tutorial->created_at->diffForHumans() }}
                                        </span>
                                        <span class="mx-3" title="更新时间：{{ $tutorial->updated_at }}">
                                            <i class="fa fa-clock-o text-success"></i> {{ $tutorial->updated_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <hr>
                                    <div class="card-text">
                                        {!! $tutorial->stringToMarkdown($tutorial->description) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                @endif
            @endforeach
        @endif
    </div>
</div>
@endsection
