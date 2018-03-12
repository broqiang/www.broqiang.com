@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center text-warning"> 404 </h1>

            <div class="dropdown-divider"></div>
            
            <h3 class="text-center text-muted">
                 访问的地址不存在 ! 
            </h3>
            
            <p>{{ $exception->getMessage() }}</p>
        </div>
    </div>
</div>
@endsection
