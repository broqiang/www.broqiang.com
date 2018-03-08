@if (count($errors) > 0)
    <div class="container-fluid">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-remove"></i>
            </button>
            <h5>有错误发生：</h5>
            <ol>
                @foreach ($errors->all() as $error)
                    <li><i class="fa fa-remove"></i> {{ $error }}</li>
                @endforeach
            </ol>
        </div>
    </div>
@endif