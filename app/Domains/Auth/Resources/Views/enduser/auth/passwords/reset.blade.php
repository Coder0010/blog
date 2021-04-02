@extends("{$nameSpace}.layouts.main")

@section("title", __("site.reset_password"))

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
                        <h5>{{ __("site.reset_password") }}</h5>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ request('token') }}">
                            <div class="form-group">
                                <label for="email">{{ __("site.email") }}</label>
                                <input name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old("email") }}" autocomplete="off">
                            </div>
                            @foreach (["password", "password_confirmation"] as $item)
                                <div class="form-group">
                                    <label for="{{ $item }}">{{ __("site.{$item}") }}</label>
                                    <input type="password" name="{{ $item }}" id="{{ $item }}" class="form-control @error($item) is-invalid @enderror" value="{{ old($item) }}">
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-block btn-lg sign-btn">{{ __("site.reset_password") }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
