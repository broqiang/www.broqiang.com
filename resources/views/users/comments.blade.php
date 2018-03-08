@extends('layouts.app')

@section('title',$user->name . '评论的文章')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-2">
                <div class="card-header bg-white">
                    <h4 class="text-muted">评论的文章</h4>
                </div>
                @if(count($comments))
                    <ul class="list-group">
                        @foreach($comments as $comment)
                            <li class="list-group-item ">
                                <span class="pull-left">
                                    <a href="{{ route('posts.show', $comment->post->id) }}" class="text-info" title="阅读文章">{{ $comment->post->title }}</a>
                                </span>
                                <span class="pull-right">
                                    <a href="{{ route('skills.show', $comment->post->skill->id) }}" class="text-muted" title="所属技能">{{ $comment->post->skill->name }}</a>
                                    <span class="text-muted" title="发表时间">
                                        &#x2022; {{ $comment->post->created_at->diffForHumans() }}
                                    </span>
                                    <span class="text-muted" title="最后回复时间">
                                        &#x2022; {{ $comment->post->updated_at->diffForHumans() }}
                                    </span>
                                    <span class="text-muted" title="关注人数">
                                        &#x2022; {{ $comment->post->follow_count }}
                                    </span>
                                    <span class="text-muted" title="评论数">
                                        &#x2022; {{ $comment->post->comment_count }}
                                    </span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-footer bg-white">
                        {{ $comments->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @else
                    <div class="card-body">
                        <p class="lead">还没有关注任何文章，快去阅读吧 ~ </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop

