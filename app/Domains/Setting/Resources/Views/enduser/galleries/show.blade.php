@extends("enduser.layouts.main")

@section("title", $title)

@section('content')
    <section class="page-inner">
        <div class="container page-content">
            <div class="row justify-content-md-center row-eq-height">
                <div class="col-md-6">
                    <div class="blog-img">
                        <img src="{{ $item->getMainMedia() }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>{{ $item->name_val }}</h3>
                    <p> {!! $item->description_val !!} </p>
                </div>
            </div>
        </div>
    </section>
@endsection
