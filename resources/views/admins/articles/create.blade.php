    <div class="card">
        <div class="card-body p-4 text-muted">
            <form method="POST" class="js-modal-form" action="{{ route('admins.articles.store', $tutorial->alias) }}">
                @csrf
                <div class="form-group">
                    <label for="title">文章标题</label>

                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus placeholder="输入标题">
                </div>
                <div class="form-group">
                    <label for="alias">别名</label>

                    <input type="text" class="form-control" name="alias" value="{{ old('alias') }}" required placeholder="输入别名">
                    <small>用来访问的路径，别名只能由 <code>字母、数字、破折号（ - ）以及下划线（ _ ）</code>组成，并且<code>不能重复</code></small>
                </div>
                
                @isset($pid)
                    <input type="hidden" name="pid" value="{{ $pid }}">
                @endisset
                        
                <div class="form-group">
                    <label for="title">排序</label>

                    <input type="number" class="form-control" name="sort" value="{{ old('sort') }}" placeholder="输入整形数字">
                </div>
            </form>
        </div>
    </div>
</div>
