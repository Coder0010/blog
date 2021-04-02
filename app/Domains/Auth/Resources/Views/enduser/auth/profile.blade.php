@extends("{$nameSpace}.layouts.main")

@section("title", __("site.profile"))

@section("content")
    <section class="settings-boxes">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="box">
                        <h3>{{ __("site.settings") }}</h3>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-general-setting-tab" data-toggle="pill" href="#v-pills-general-setting" role="tab" aria-controls="v-pills-general-setting" aria-selected="true">
                                <img src="{{ asset('enduser/images/account.png') }}"> {{ __("site.general") }}
                            </a>
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();">
                                <img src="{{ asset('enduser/images/logout.png') }}"> {{ __('site.logout') }}
                                <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" class="none"> @csrf </form>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-general-setting" role="tabpanel" aria-labelledby="v-pills-general-setting-tab">
                                <h3>{{ __("site.general_settings") }}</h3>
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method("patch")
                                    <div class="form-row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">{{ __("site.first_name") }}</label>
                                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ @explode("-", $user->name)[0] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">{{ __("site.last_name") }}</label>
                                                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ @explode("-", $user->name)[1] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __("site.email") }}</label>
                                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">{{ __("site.phone") }}</label>
                                        <input type="number" name="phone" id="phone" value="{{ $user->phone }}" class="form-control @error('phone') is-invalid @enderror" autocomplete="off">
                                    </div>
                                    <div class="form-row social-login">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __("site.date_of_birth") }}</label>
                                            </div>
                                        </div>
                                        @foreach (["day", "month", "year"] as $item)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select id="{{ $item }}" name="{{ $item }}" class="form-control @error($item) is-invalid @enderror">
                                                        <option value="" disabled selected>{{ $item }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-row">
                                        @foreach (["password", "password_confirmation"] as $item)
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="{{ $item }}">{{ __("site.{$item}") }}</label>
                                                    <input type="password" name="{{ $item }}" id="{{ $item }}" class="form-control @error($item) is-invalid @enderror" value="{{ old($item) }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-block btn-lg sign-btn">{{ __("site.save") }}</button>
                                </form>
                            </div> <!-- general-setting -->
                        </div>
                    </div>
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
        setTimeout(() => {
            $("#day").val( "{{ $user->date['day'] }}" ).trigger("change");
            $("#month").val( "{{ $user->date['month'] }}" ).trigger("change");
            $("#year").val( "{{ $user->date['year'] }}" ).trigger("change");
        }, 100);
    </script>
@endsection
