@extends('layouts.app') 

@section('title', $tutorial->title) 

@section('css')
{!! markdown_preview_css() !!}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3" >
            <div class="card text-muted sidebar-follows">
                <div class="card-header bg-transparent">
                    <h3>
                        <a href="{{ route('tutorials.show', $tutorial->slug) }}" class="text-muted">{{ $tutorial->title }}</a>
                    </h3>
                </div>
                @if(count($tutorial->articles))
                    <div class="card-body scroll-bar" style="overflow-y: auto;">
                        <nav class="nav flex-column">
                            @foreach($tutorial->articles as $tarticle)
                                <a class="my-2 nav-link font-weight-bold text-truncate 
                                    {{ isset($article) && $tarticle->id === $article->id ? 'bg-dark text-light' : 'text-muted' }}" 
                                    href="{{ $tarticle->link($tutorial) }}" title="{{ $tarticle->title }} -- {{ $tarticle->slug }}" 
                                    style="max-width: 100%">
                                    <i class="fa fa-folder mr-1 text-info"></i>
                                    {{ $tarticle->title }}
                                </a>
                                @if(count($tarticle->children_articles))
                                    @foreach($tarticle->children_articles as $children_article)
                                        <a class="nav-link text-truncate 
                                            {{ isset($article) && $children_article->id === $article->id ? 'bg-dark text-light' : 'text-muted' }}" 
                                            href="{{ $children_article->link($tutorial) }}" 
                                            title="{{ $children_article->title }} -- {{ $children_article->slug }}" style="max-width: 100%">
                                            <i class="fa fa-file-text mr-1 ml-4"></i>
                                            {{ $children_article->title }}
                                        </a>
                                    @endforeach
                                @endif
                            @endforeach
                        </nav>                        
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-9">
            @isset($article)
                <div class="card text-muted">
                    <div class="card-header bg-transparent">
                        <h4>{{ $article->title }}</h4>
                    </div>
                    <div class="card-body">
                        <article class="markdown-body">
                            {!! $article->body !!}
                        </article>
                    </div>
                </div>
            @else
                <div class="card text-muted">
                    <div class="card-body bg-transparent">
                        <p class="card-text">
                            {!! $tutorial->description !!}
                        </p>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>
@stop

@section('script')
{!! markdown_preview_js() !!}
<script type="text/javascript">
</script>
@stop

