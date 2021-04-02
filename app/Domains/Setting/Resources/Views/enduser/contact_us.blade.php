@extends("enduser.layouts.main")

@section("title", $title)

@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-md-center row-eq-height text-center">
                <div class="col-md-6 mb-5">
                    <h3>{{ GetSettingTransByKey("contact_us_title") }}</h3>
                    <p> {!! GetSettingTransByKey('contact_us_description') !!} </p>
                </div>
                <div class="col-md-6 mb-5">
                    @include('auths::enduser._sections._leads')
                </div>
            </div>
        </div>
    </section>
@endsection
