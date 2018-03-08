<div class="container-fluid js-message">
    @if (Session::has('message'))
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-remove"></i>
            </button>
            {{ Session::get('message') }}
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-remove"></i>
            </button>
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('danger'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-remove"></i>
            </button>
            {{ Session::get('danger') }}
        </div>
    @endif
</div>
