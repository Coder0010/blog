<!DOCTYPE html>
<!--[if IE 8]>
<html lang="{{ GetLanguage() }}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ GetLanguage() }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ GetLanguage() }}" dir="{{ GetDirection() }}" style="direction: {{ GetDirection() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta http-equiv="cache-control" content="private, max-age=0, no-cache" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" / />
        <meta name="turbolinks-cache-control" content="no-cache" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="author" content="{{ config("system.developer.name") }}" />
        <meta property="og:author" content="{{ config("system.developer.name") }}" />
        <meta property="og:title" content="{{ GetSettingTransByKey("name") ?? config("app.name") }}" />
        <meta property="og:description" content="{{ GetSettingTransByKey("description") }}" />
        <meta property="og:image" content="{{ GetSettingMediaUrl("favicon_".GetLanguage()) }}" />
        <title> {{ GetSettingTransByKey("name") ?? config("app.name") }} || @yield("title") </title>
        <link href='{{ GetSettingMediaUrl("favicon_".GetLanguage()) }}' rel="shortcut icon" type="image/png">
        <link href="{{ asset('enduser/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('enduser/compiled.css') }}" rel="stylesheet" type="text/css" />
        @if(App::isLocale('ar'))
            <link href="{{ asset('enduser/lib/bootstrap/css/bootstrap-rtl.css') }}" rel="stylesheet"/>
        @endif
        @yield("styles")
    </head>
    <body>
        <div id="app">
            <div id="preloader">
                <div class="jumper">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            @include("enduser.partials._header_content")

            @yield("content")

            @include("enduser.partials._footer_content")
        </div>

        <script src="{{ asset('enduser/compiled.js') }}"></script>
        <script>
            window.W_User = @json(auth()->user());
            window.W_Locale = '{{ GetLanguage() }}';
            window.W_Translations = {!! cache('translations') ?? [] !!};
        </script>
        <script src="{{ asset('enduser/app.js') }}"></script>
        <script language = "text/Javascript">
            cleared[0] = cleared[1] = cleared[2] = 0;
            function clearField(t){
                if(! cleared[t.id]){
                    cleared[t.id] = 1;
                    t.value='';
                    t.style.color='#fff';
                }
            }
        </script>
        @yield("js_scripts")
    </body>
</html>
