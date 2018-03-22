    <div class="card">
        <div class="card-body p-4 text-muted">
            <form method="POST" class="js-modal-form" action="{{ isset($article) ? route('admins.articles.update', $article->alias) : route('admins.articles.store') }}">
                @csrf

                @isset($article)
                    <input type="hidden" name="_method" value="PUT">
                @endisset

                <div class="form-group">
                    <label for="title">文章标题</label>

                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', isset($article) ? $article->title : '') }}" required autofocus placeholder="输入标题">

                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="alias">别名</label>

                    <input type="text" class="form-control {{ $errors->has('alias') ? ' is-invalid' : '' }}" name="alias" value="{{ old('alias', isset($article) ? $article->alias : '') }}" required autofocus placeholder="输入别名">

                    @if ($errors->has('alias'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('alias') }}</strong>
                        </span>
                    @endif
                    <small>用来访问的路径，别名只能由 <code>字母、数字、破折号（ - ）以及下划线（ _ ）</code>组成，并且<code>不能重复</code></small>
                </div>
                        
                <div class="form-group">
                    <label for="title">排序</label>

                    <input type="number" class="form-control {{ $errors->has('sort') ? ' is-invalid' : '' }}" name="sort" value="{{ old('sort', isset($article) ? $article->sort : '') }}" placeholder="输入整形数字">

                    @if ($errors->has('sort'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('sort') }}</strong>
                        </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
