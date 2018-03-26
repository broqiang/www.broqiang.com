    <div class="card">
        <div class="card-body p-4 text-muted">
            <form method="POST" class="js-modal-form" action="{{ route('admins.articles.update', [$tutorial->slug, $article->id]) }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="title">文章标题</label>

                    <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}" required autofocus placeholder="输入标题">
                </div>

                <div class="form-group">
                    <label for="slug">slug</label>

                    <input type="text" class="form-control" name="slug" value="{{ old('slug', $article->slug) }}" required placeholder="输入别名">
                    <small class="ml-2">用来访问的路径，默认值是由百度翻译自动生成，只能是 <code>字母、数字、破折号（ - ）以及下划线（ _ ）</code></small>
                </div>
                                        
                <div class="form-group">
                    <label for="title">排序</label>

                    <input type="number" class="form-control" name="sort" value="{{ old('sort', $article->sort) }}" placeholder="输入整形数字，可以为空，默认值是： 100">
                    <small>用来决定文章显示顺数，按照数字从小到大排序</small>
                </div>
            </form>
        </div>
    </div>
</div>
