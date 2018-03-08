<div class="card my-3">
    <div class="card-body">
        <form action="{{ route('posts.comment',$post->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="content" rows="5" required
                placeholder="{{ Auth::check() ? '发表评论' : '请先登录再发表评论' }}"></textarea>
            </div>

            @guest
                <div class="form-group">
                    <a class="btn btn-warning pull-right" href="{{ route('login') }}">登录</a>
                </div>
            @else
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">提交</button>
                </div>
            @endguest
        </form>        
    </div>
</div>