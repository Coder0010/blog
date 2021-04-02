@extends("{$nameSpace}.layouts.main")

@section("title", __("site.login"))

@section("content")
    <section class="signin">
        <div class="container">
            @include("adminpanel.components.flash-messages-component")
            <div class="row">
                <div class="col">
                    <div class="sign-form p-4 bg-white">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __("site.email") }}</label>
                                <input name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old("email") }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __("site.password") }}</label>
                                <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror">
                            </div>
                            <div class="form-group form-check">
                                <input id="remember" name="remember" type="checkbox" class="form-check-input">
                                <label for="remember" class="form-check-label">{{ __("site.remember_me") }}</label>
                            </div>
                            <button type="submit" class="btn btn-block btn-lg btn-info">{{ __("site.submit") }}</button>
                        </form>
                        <p class="text-center m-2">{{ __("site.or") }}</p>
                    </div>
                    <a href="{{ route("register") }}" class="btn btn-block btn-lg btn-primary">{{ __("site.create_an_account") }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection
