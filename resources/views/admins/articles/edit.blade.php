    <div class="card">
        <div class="card-body p-4 text-muted">
            <form method="POST" class="js-modal-form" action="{{ route('admins.articles.update', [$tutorial->alias, $article->alias]) }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="title">文章标题</label>

                    <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}" required autofocus placeholder="输入标题">
                </div>
                <div class="form-group">
                    <label for="alias">别名</label>

                    <input type="text" class="form-control" name="alias" value="{{ old('alias', $article->alias) }}" required placeholder="输入别名">
                    <small>用来访问的路径，别名只能由 <code>字母、数字、破折号（ - ）以及下划线（ _ ）</code>组成，并且<code>不能重复</code></small>
                </div>
                                        
                <div class="form-group">
                    <label for="title">排序</label>

                    <input type="number" class="form-control" name="sort" value="{{ old('sort', $article->sort) }}" placeholder="输入整形数字">
                </div>
            </form>
        </div>
    </div>
</div>
