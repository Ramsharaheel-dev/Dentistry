@extends ('layouts.layout_2')

@section('head')
    <title>Shop; Dian</title>
@endsection

<style>
    .input1 {
        padding: 11px 14px;
        font-size: 20px;
        height: 45px;
        width: 100%;
        text-align: center;
        border-radius: 5px;
        border: none;
        color: white;
        background: #191920;
    }

    #submit-btn {
        display: none;
    }

    i.fas.fa-search {
        font-size: 28px;
        position: relative;
        top: 13px;
        right: 40px;
    }
</style>



@section('content')
    <div class="content-body">

        {{-- @include('pages.subheader') --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 ">
                    <p class="your_perso pt-5">PubMed search</p>

                    <div class="col-md-12">

                    </div>

                </div>
                <div class="col-md-6 ">


                </div>

            </div>
            <div class="row py-4">
                <div class="col-md-11">
                    <form id="pubmedSearchForm" method="POST" target="_blank" action="{{ route('submitPubMed') }}">
                        @csrf

                        <div class="input-group search-area">
                            <input type="text" id="searchQuery" name="searchWord" class="form-control2"
                                placeholder="Enter your search term..." style="height: 60px !important">
                            <label for="submit-btn">
                                <i class="fas fa-search" style="cursor: pointer;"></i>
                            </label>
                            <input type="submit" id="submit-btn">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
