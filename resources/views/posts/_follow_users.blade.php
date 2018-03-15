<div class="card mb-5">
    <div class="card-header bg-white">
        <center>
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-success disable">登录后可以关注</a>
            @else
                <button class="btn btn-outline-success" onclick="event.preventDefault();document.getElementById('post-follow-form').submit();">
                    @whether_follow($post->follows)
                        取消关注
                        <form action="{{ route('posts.unfollow', $post->id) }}" id="post-follow-form" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        关注
                        <form action="{{ route('posts.follow', $post->id) }}" id="post-follow-form" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endwhether_follow
                </button>
            @endguest
        </center>
    </div>
    @if(count($post->follows))
        <div class="card-body">
            @foreach($post->follows as $user)
                <span class="badge badge-pill badge-light">
                    <a href="{{ route('users.show',$user->id) }}">
                    <img src="{{ $user->avatar ?: 'https://image.broqiang.com//broqiang/empty-white.png' }}" width="33px" height="33px">
                    </a>
                </span>
            @endforeach
        </div>
    @else
    
    @endif
</div>