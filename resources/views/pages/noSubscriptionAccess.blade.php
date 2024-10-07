@extends ('layouts.layout_2')

@section('head')
    <title>Dian</title>
@endsection

<style>
    .assist-btn {
        color: #F8B940 !important;
        font-weight: bold;
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
                    <p class="jhon-doe text-center">{{ $message }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
