<div class="card mb-2">
    <div class="card-header bg-white">
        <a href="{{ route('users.comments', $user->id) }}" class="btn btn-info btn-sm pull-right">查看全部</a>
        <h4 class="text-muted">评论的文章</h4>
    </div>
    @if(count($user->commentsPreview))
        <ul class="list-group">
            @foreach($user->commentsPreview as $comment)
                <li class="list-group-item ">
                    <span class="pull-left">
                        <a href="{{ route('posts.show', $comment->post->id) }}" class="text-info" title="阅读文章">{{ $comment->post->title }}</a>
                    </span>
                    <span class="pull-right">
                        <a href="{{ route('skills.show', $comment->post->skill->id) }}" class="text-muted" title="所属技能">{{ $comment->post->skill->name }}</a>
                        <span class="text-muted" title="最后回复时间">
                            &#x2022; {{ $comment->post->updated_at->diffForHumans() }}
                        </span>
                    </span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="card-body">
            <p class="text-muted">还没有评论任何文章，快去阅读吧 ~ </p>
        </div>
    @endif
</div>