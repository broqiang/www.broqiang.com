@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <center>
                <h1 class="text-warning"> 403 </h1>

                <div class="dropdown-divider"></div>
                
                <h3 class="text-muted">
                     没有访问权限 ！ 
                </h3>
                
                <p>{{ $exception->getMessage() }}</p>
            </center>
        </div>
    </div>
</div>
@endsection
