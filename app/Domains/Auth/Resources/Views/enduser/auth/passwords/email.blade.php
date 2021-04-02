@extends("{$nameSpace}.layouts.main")

@section("title", __("site.login"))

@section("content")
    <section class="signin">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="welcome-text">
                        <h3> {{ __("site.a_mind_that_is_stretched_by_a_new_experience_can_never_go_back_to_its_old_dimensions") }} </h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="sign-form p-4 bg-white">
                        <h5>{{ __("site.forget_password") }}</h5>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __("site.email") }}</label>
                                <input name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old("email") }}" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-block btn-lg sign-btn">{{ __("site.forget_password") }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
