@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card text-muted">
        <div class="card-header bg-transparent">
            <h1 class="text-danger text-center"> 404 !</h1>
            <h5 class="card-title text-center my-3">访问的地址不存在！</h5>
        </div>
        <div class="card-body">
            <p class="text-muted my-3">如果你访问的是迁移之前的地址，点击上面的菜单，还可以找到相应的文章</p>
        </div>
    </div>
</div>
@endsection
