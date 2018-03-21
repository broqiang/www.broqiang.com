@extends('admins.app') 

@section('title', '教程列表') 

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-muted">
                <div class="card-header bg-transparent">
                    <div class="d-flex justify-content-between">
                        <div class="p-2 bd-highlight"><h3>{{ $tutorial->title }}</h3></div>
                        <div class="p-2 bd-highlight">
                            <a href="{{ route('admins.tutorials.article', $tutorial->id) }}" class="btn btn-outline-success btn-sm" title="添加文章">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card text-muted">
                <div class="card-body bg-transparent">
                    djsakdjlksajlksda
                </div>
            </div>
        </div>
    </div>
</div>
@stop