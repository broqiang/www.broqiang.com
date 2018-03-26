@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card text-muted">
        <div class="card-header bg-transparent">
            <h1 class="text-danger text-center"> 403 !</h1>
            <h5 class="card-title text-center my-3">没有访问权限</h5>
        </div>
        <div class="card-body">
            <p>{{ $exception->getMessage() }}</p>
        </div>
    </div>
</div>
@endsection
