@extends("enduser.layouts.main")

@section("title", $title)

@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-md-center row-eq-height text-center">
                <div class="col-12 mb-5">
                    <h3>{{ GetSettingTransByKey('galleries_title') }}</h3>
                    <p> {!! GetSettingTransByKey('galleries_description') !!} </p>
                </div>
                <div class="col mb-5">
                    @include('settings::enduser._sections._galleries')
                </div>
            </div>
        </div>
    </section>
@endsection
