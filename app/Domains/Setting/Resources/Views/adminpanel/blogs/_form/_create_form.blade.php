@component("adminpanel.components.form-component")
    @slot("permission", "Create_Blog")

    @slot("formID", "blogCreateFormID")

    @slot("formAction", route("admin.blogs.store"))

    @slot("formInputs")
        @php
            $blog_create_en_errors = "";
            $blog_create_ar_errors = "";
            $blog_create_inputs = ["blog_create_name", "blog_create_description"];
        @endphp
        @foreach ($blog_create_inputs as $item)
            @error("{$item}_en")
                @php
                    $blog_create_en_errors = "text-danger en";
                @endphp
                @break
            @enderror
        @endforeach
        @foreach ($blog_create_inputs as $item)
            @error("{$item}_ar")
                @php
                    $blog_create_ar_errors = "text-danger ar";
                @endphp
                @break
            @enderror
        @endforeach

        <div class='card card-custom gutter-b'>
            <div class='card-header card-header-tabs-line'>
                <div class='card-title'>
                    <h3 class='card-label'>{{ __("main.create") }}</h3>
                </div>
                <div class='card-toolbar'>
                    <ul class='nav nav-tabs nav-bold nav-tabs-line'>
                        @if(count(AppLanguages()) > 1)
                            @foreach (AppLanguages() as $lang)
                                <li class='nav-item'>
                                    <a class='nav-link {{ $lang == "en" ? $blog_create_en_errors : $blog_create_ar_errors }} {{ $loop->first ? "active" : "" }}' href='#{{ "create-blog-{$lang}-tab" }}' data-toggle='tab'>
                                        <span class='symbol symbol-20 m-2'>
                                            <img src='{{ asset(GetLanguageValues($lang, "flag")) }}' alt='{{ GetLanguageValues($lang,'name') }}'/>
                                        </span>
                                        <span class='navi-text'> {{ GetLanguageValues($lang, "name") }} </span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class='card-body'>
                <div class='tab-content'>
                    @foreach (AppLanguages() as $lang)
                        <div class='tab-pane fade {{ $loop->first ? "active show" : '' }}' id='{{ "create-blog-{$lang}-tab" }}' role="tabpanel" aria-labelledby='{{ "create-blog-{$lang}-tab" }}'>
                            @component("adminpanel.components.html-tags.general")
                                @slot("tagName", "blog_create_name_{$lang}")
                                @slot("tagTitle", __("main.name_{$lang}"))
                                @slot("tagValue", old("blog_create_name_{$lang}"))
                            @endcomponent
                            @component("adminpanel.components.html-tags.textarea")
                                @slot("tagEditor", true)
                                @slot("tagName", "blog_create_description_{$lang}")
                                @slot("tagTitle", __("main.description_{$lang}"))
                                @slot("tagValue") {!! old("blog_create_description_{$lang}") !!} @endslot
                            @endcomponent
                        </div>
                    @endforeach

                    <div class="separator separator-solid separator-border-2 separator-dark mb-3"></div>

                    @component("adminpanel.components.html-tags.select")
                        @slot("tagOptions", $categories)
                        @slot("tagTitle", __("main.category"))
                        @slot("tagName", "blog_create_category_id")
                        @slot("tagValue", old("blog_create_category_id"))
                    @endcomponent

                    @component("adminpanel.components.html-tags.image")
                        @slot("tagTitle", __("main.image"))
                        @slot("tagName", "blog_create_image")
                    @endcomponent
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.blogs.create"))
            <script>
                function blogCreateModalJsFunction(){
                    toggleModalCreate("blog");
                }
            </script>
        @elseif(Route::is("admin.blogs.create"))
            <script>  </script>
        @endif
    @endslot
@endcomponent

