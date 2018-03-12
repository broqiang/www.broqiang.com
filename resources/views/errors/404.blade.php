@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <center>
                <h1 class="text-warning"> 404 </h1>

                <div class="dropdown-divider"></div>
                
                <h3 class="text-muted">
                     访问的地址不存在 ! 
                </h3>

                <p class="text-muted my-3">如果你访问的是迁移之前的地址，点击上面的菜单，还可以找到相应的文章</p>

                <p>{{ $exception->getMessage() }}</p>
            </center>
        </div>
    </div>
</div>
@endsection
