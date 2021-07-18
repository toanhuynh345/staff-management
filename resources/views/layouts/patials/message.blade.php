@if (session('message'))
    <div class="alert alert-info alert-dismissible fade show mb-0 font-weight-normal" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>

        {!! session('message') !!}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show mb-0 font-weight-normal" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>

        {!! session('warning') !!}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-0 font-weight-normal" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>

        {!! session('error') !!}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-0 font-weight-normal" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>

        {!! session('success') !!}
    </div>
@endif
