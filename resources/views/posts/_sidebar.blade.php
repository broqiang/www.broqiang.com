<div class="card mb-3 border-info">
    <div class="card-header bg-transparent border-info">
        <h5 class="text-muted text-center">公告</h5>
    </div>
    <div class="card-body">
        <article class="text-muted">
            博客正式从原来的 Github Page 迁移到这里，原本的内容可以通过 
            <a class="text-info" href="https://broqiang.github.io" target="_blank">broqiang.github.io</a> 访问
        </article>
    </div>
</div>

<div class="card border-info mb-3">
    <div class="card-header bg-transparent border-info">
        <h5 class="text-muted text-center">归档</h5>
    </div>
    @if(count($archives))
        <ul class="list-group list-group-flush">
            @foreach($archives as $archive)
                <li class="list-group-item @if(request()->has('year') && request()->year == $archive->year) bg-light @endif">
                    <a href="{{ route('posts.index') }}?year={{ $archive->year }}@if(request()->has('order'))&order={{ request()->order }}@endif" 
                        class="text-center text-info font-weight-bold">
                        <center>{{ $archive->year }} ( {{ $archive->total }} )</center>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>