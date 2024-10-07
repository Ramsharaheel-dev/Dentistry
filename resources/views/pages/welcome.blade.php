@extends ('layouts.layout_profile')

@section('head')
    <title>Dian</title>
@endsection

<style>
    .assist-btn {
        color: #F8B940 !important;
        font-weight: bold;
        display: none;
    }

    .header-right .search-area {
        width: 15.625rem;
        display: none;
    }

    [data-theme-version="dark"][data-layout="vertical"][data-sidebar-position="fixed"] .deznav {
        border-color: rgba(255, 255, 255, 0.1);
        display: none;
    }

    .content-body {
        margin-left: auto !important;
        height: 40vh;
    }

    .content-body {
        width: 100%;
        height: 31vh;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    [data-header-position="fixed"] .content-body {
        padding-top: 0rem !important;
    }
</style>


@section('content')
    <div class="content-body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="jhon-doe text-center">Payment has been successfull and subscription activated
                    </p>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-md-12 text-center">
                    <a href="{{ route('setup-profile') }}">
                        <button type="button" class="btn3 btn-secondary anek-telugu">Complete Your Profile</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
