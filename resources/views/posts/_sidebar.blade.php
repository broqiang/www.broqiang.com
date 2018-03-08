<div class="card mb-3">
    <div class="card-header bg-transparent">
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