@extends("{$nameSpace}.layouts.main")

@section("title", __("site.register"))

@section("content")
    <section class="signin">
        <div class="container">
            @include("adminpanel.components.flash-messages-component")
            <div class="row">
                <div class="col">
                    <div class="sign-form p-4 bg-white">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-row mb-2">
                                @foreach (["first_name", "last_name"] as $item)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="{{ $item }}">{{ __("site.{$item}") }}</label>
                                            <input type="text" name="{{ $item }}" id="{{ $item }}" class="form-control @error($item) is-invalid @enderror" value="{{ old($item) }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __("site.email") }}</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old("email") }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ __("site.phone") }}</label>
                                <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old("phone") }}" autocomplete="off">
                            </div>
                            <div class="form-row">
                                @foreach (["password", "password_confirmation"] as $item)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="{{ $item }}">{{ __("site.{$item}") }}</label>
                                            <input type="password" name="{{ $item }}" id="{{ $item }}" class="form-control @error($item) is-invalid @enderror" value="{{ old($item) }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-block btn-lg btn-info">{{ __("site.submit") }}</button>
                        </form>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-block btn-lg btn-primary">{{ __("site.sign_in") }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("js_scripts")
    <script>
        for (let i = 1; i < 31; i++) {
            $("#day").append(new Option(i, i));
        }
        var months = @json(config("system.months"));
        $.each(months, function(key, value){
            $("#month").append(new Option(value, value));
        });

        var start_year = new Date().getFullYear();
        for (let i = 1971; i <= start_year; i++) {
            $("#year").append(new Option(i, i));
        }
    </script>
@endsection
