@extends("{$nameSpace}.layouts.main")

@section("title", $title)

@php
    $forms_crud = [
        "navbar-form",
        "seo-form",
    ];
    $error_type = "";
    $navbar_form_errors = "";
    $seo_form_errors = "";
@endphp
@foreach (["navbar_trans_home", "navbar_trans_contact_us", "navbar_trans_about_us"] as $item)
    @error("{$item}_en")
        @php $navbar_form_errors = "text-danger en"; @endphp
        @break
    @enderror
    @error("{$item}_ar")
        @php $navbar_form_errors = "text-danger ar"; @endphp
        @break
    @enderror
@endforeach

@foreach (["name", "keywords", "description", "favicon", "logo"] as $item)
    @error("{$item}_en")
        @php $seo_form_errors = "text-danger en"; @endphp
        @break
    @enderror
    @error("{$item}_ar")
        @php $seo_form_errors = "text-danger ar"; @endphp
        @break
    @enderror
@endforeach

@section("content")

    <form class='form row' id='setting-form' method='POST' action='{{ route("admin.settings.update") }}' enctype='multipart/form-data'>

        @method('post')
        @csrf

        <div class='col-12 mb-5'>
            <button type='submit' class='btn btn-success col'>{{ __('main.submit') }}</button>
        </div>
        <div class='col-md-3 col-sm-12'>
            <ul class='nav nav-pills nav-boldest flex-column text-center' id='settings-tabs' role='tablist'>
                @foreach ($forms_crud as $form)
                    @switch($form)
                        @case("navbar-form")
                            @php $error_type = $navbar_form_errors; @endphp
                            @break
                        @case("seo-form")
                            @php $error_type = $seo_form_errors; @endphp
                            @break
                    @endswitch
                    <li class="nav-item">
                        <a class='nav-link {{ $loop->first ? 'active' : "" }}' id='{{ "{$form}-btn-pill" }}' href='#{{ "{$form}-tab" }}' data-toggle='tab' role="tab" aria-controls="{{ $form }}" aria-selected="true">
                            <span class='nav-text {{ $error_type }}'>{{ __("main.{$form}-setting") }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class='col-md-9 col-sm-12'>
            <div class='tab-content' id='all-settings-tab'>
                @foreach ($forms_crud as $form)
                    <div class='tab-pane fade {{ $loop->first ? "active show" : "" }}' id='{{ "{$form}-tab" }}' aria-labelledby='{{ "{$form}-btn-pill" }}' role='tabpanel'>
                        @include("settings::adminpanel.settings.forms.{$form}")
                    </div>
                @endforeach
            </div>
        </div>
        <div class='col-12 mt-5'>
            <button type='submit' class='btn btn-success col'>{{ __('main.submit') }}</button>
        </div>

    </form>

@endsection

@section("js_scripts")
    <script>
        @unlessrole('Super_Role')
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        @endunlessrole

        $(document).ready(function(){
            langs.forEach(lang => {
                initTagify(`keywords_`+lang);
            });
        });

    </script>
@endsection
