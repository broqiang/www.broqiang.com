<div class="card mb-2">
    <div align="center">
        <img class="rounded img-thumbnail my-5 mx-auto" src="{{ $user->avatar ?: 'https://image.broqiang.com//broqiang/empty-white.png' }}" alt="avatar">
    </div>
    
    <div class="card-body">
        <div class="dropdown-divider mb-5"></div>
        <h4 class="card-title">
            <i class="fa fa-user text-success"></i>
            {{ $user->name }} <small class="text-secondary">{{ $user->email }}</small>
        </h4>
        <h6 class="card-title">
            <span><i class="fa fa-clock-o"></i> 注册于:</span> 
            <span>{{ $user->created_at->diffForHumans() }}</span>
        </h6>
        <h6 class="card-title">
            <span><i class="fa fa-clock-o"></i> 活跃:</span> 
            <span>{{ $user->updated_at->diffForHumans() }}</span>
        </h6>

        <div class="dropdown-divider  my-5"></div>
        <p class="card-text">{{ $user->introduction }}</p>
       
        <div class="my-5"></div>
        
        @if($user->github)
            <a href="{{ $user->github }}" class="btn btn-secondary mb-3" target="_blank">
                <i class="fa fa-github"></i> Github
            </a>
        @endif
        @if($user->homepage)
            <a href="{{ $user->homepage }}" class="btn btn-secondary mb-3"  target="_blank">
                <i class="fa fa-paper-plane"></i> 个人主页
            </a>
        @endif
        @if($user->weibo)
            <a href="{{ $user->weibo }}" class="btn btn-secondary mb-3"  target="_blank">
                <i class="fa fa-weibo"></i> 微博 
            </a>
        @endif
    </div>
</div>