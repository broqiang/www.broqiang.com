@if(count($posts)>0)
    @foreach($posts as $post)
        <div class="card my-3">
            <div class="card-body">
                <h3 class="card-title">
                    <a class="text-muted" href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                </h3>
                <h5 class="card-subtitle my-4">
                    <a href="{{ route('users.show',$post->user->id) }}" class="font-italic text-info">
                        {{ $post->user->name }}
                    </a>
                    <small class="font-italic text-muted mx-3" title="发布时间">
                        <i class="fa fa-clock-o"></i>
                        {{ $post->created_at->diffForHumans() }}
                    </small>
                </h5>
                <hr>
                <p class="card-text font-weight-light ">{!! $post->excerpt !!}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success pull-right font-italic">
                    阅读 &#x2022; &#x2022; &#x2022;
                </a>
            </div>
        </div>
    @endforeach
@else
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">没有任何数据</h5>
        </div>
    </div>
@endif