<div class="card mb-5">
    <div class="card-header bg-white">
        <a href="{{ route('users.follows', $user->id) }}" class="btn btn-info btn-sm pull-right">查看全部</a>
        <h4 class="text-muted">关注的文章</h4>
    </div>
    @if(count($user->follows))
        <ul class="list-group">
            @foreach($user->follows as $post)
                <li class="list-group-item ">
                    <span class="pull-left">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-info" title="阅读文章">{{ $post->title }}</a>
                    </span>
                    <span class="pull-right">
                        <a href="{{ route('skills.show', $post->skill->id) }}" class="text-muted" title="所属技能">{{ $post->skill->name }}</a>
                        <span class="text-muted" title="发表时间">
                            &#x2022; {{ $post->created_at->diffForHumans() }}
                        </span>
                    </span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="card-body">
            <p class="text-muted">还没有关注任何文章，快去阅读吧 ~ </p>
        </div>
    @endif
</div>