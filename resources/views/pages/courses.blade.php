@extends ('layouts.layout_2')

@section('head')
    <title>Courses; Dian</title>
@endsection

<style>


</style>

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <p class="introducin">Courses</p>
            <div class="row">

                @foreach ($courses as $course)
                    <div class="col-md-4 pt-3">
                        <a href="{{ $course->url }}" target="_blank">
                            <img class="w-100" src="{{ asset('courses/' . $course->thumbnail_name) }}" />
                        </a>
                    </div>
                @endforeach

            </div>
            <div class="row py-4">
                <div class="col-md-12">
                    <button type="button" class="btn1 btn-secondary anek-telugu">New Content Released Every Month</button>
                </div>
            </div>

        </div>
    </div>
@endsection
