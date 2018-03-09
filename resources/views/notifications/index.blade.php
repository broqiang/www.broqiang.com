@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-white">
            <h3 class="text-muted text-center p-3">
                <i class="fa fa-bell-o text-success"></i>
                我的通知
            </h3>
        </div>
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item text-muted">
                    <span class="pull-left">
                        <a class="text-info" href="{{ route('users.show', $notification->data['user_id']) }}">
                            <img src="{{ $notification->data['user_avatar'] }}" alt="" width="22">
                            {{ $notification->data['user_name'] }}
                        </a>
                        对
                        <a class="text-info" href="{{ route('posts.show', $notification->data['post_id']) }}">
                            {{ $notification->data['post_title'] }}
                        </a>
                        评论了:
                    </span>
                    <small class="pull-right">
                        <i class="fa fa-clock-o"></i> {{ $notification->created_at->diffForHumans() }}
                    </small>
                    
                    <div class="clearfix"></div>

                    <div class="card my-3">
                        <div class="card-body">
                            {{ $notification->data['comment_content'] }}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
