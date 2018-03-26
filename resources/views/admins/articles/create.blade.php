    <div class="card">
        <div class="card-body p-4 text-muted">
            <form method="POST" class="js-modal-form" action="{{ route('admins.articles.store', $tutorial->slug) }}">
                @csrf
                <div class="form-group">
                    <label for="title">文章标题</label>

                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus placeholder="输入标题">
                </div>
                
                @isset($pid)
                    <input type="hidden" name="pid" value="{{ $pid }}">
                @endisset
                        
                <div class="form-group">
                    <label for="title">排序</label>
                    <input type="number" class="form-control" name="sort" value="{{ old('sort') }}" placeholder="输入整形数字，可以为空，默认值是： 100">
                    <small>用来决定文章显示顺数，按照数字从小到大排序</small>
                </div>
            </form>
        </div>
    </div>
</div>
