@component("adminpanel.components.form-component")
    @slot("permission", "Edit_Blog")

    @slot("formID", "blogEditFormID")

    @slot("formMethod", "patch")

    @if(Route::is("admin.blogs.edit"))
        @slot("formAction", route("admin.blogs.update", $edit->id))
    @endif

    @slot("formInputs")
        @php
            $blog_edit_en_errors = "";
            $blog_edit_ar_errors = "";
            $blog_edit_inputs = ["blog_edit_name", "blog_edit_description"];
        @endphp
        @foreach ($blog_edit_inputs as $item)
            @error("{$item}_en")
                @php
                    $blog_edit_en_errors = "text-danger en";
                @endphp
                @break
            @enderror
        @endforeach
        @foreach ($blog_edit_inputs as $item)
            @error("{$item}_ar")
                @php
                    $blog_edit_ar_errors = "text-danger ar";
                @endphp
                @break
            @enderror
        @endforeach

        <div class='card card-custom gutter-b'>
            <div class='card-header card-header-tabs-line'>
                <div class='card-title'>
                    <h3 class='card-label'>{{ __("main.edit") }}</h3>
                </div>
                <div class='card-toolbar'>
                    <ul class='nav nav-tabs nav-bold nav-tabs-line'>
                        @if(count(AppLanguages()) > 1)
                            @foreach (AppLanguages() as $lang)
                                <li class='nav-item'>
                                    <a class='nav-link {{ $lang == "en" ? $blog_edit_en_errors : $blog_edit_ar_errors }} {{ $loop->first ? "active" : "" }}' href='#{{ "edit-blog-{$lang}-tab" }}' data-toggle='tab'>
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
                        <div class='tab-pane fade {{ $loop->first ? "active show" : '' }}' id='{{ "edit-blog-{$lang}-tab" }}' role="tabpanel" aria-labelledby='{{ "edit-blog-{$lang}-tab" }}'>
                            @component("adminpanel.components.html-tags.general")
                                @slot("tagName", "blog_edit_name_{$lang}")
                                @slot("tagTitle", __("main.name_{$lang}"))
                                @if(Route::is("admin.blogs.edit"))
                                    @slot("tagValue", $edit["name_{$lang}"])
                                @endif
                            @endcomponent
                            @component("adminpanel.components.html-tags.textarea")
                                @slot("tagEditor", true)
                                @slot("tagName", "blog_edit_description_{$lang}")
                                @slot("tagTitle", __("main.description_{$lang}"))
                                @if(Route::is("admin.blogs.edit"))
                                    @slot("tagValue") {!! $edit["description_{$lang}"] !!} @endslot
                                @endif
                            @endcomponent
                        </div>
                    @endforeach

                    <div class="separator separator-solid separator-border-2 separator-dark mb-3"></div>

                    @component("adminpanel.components.html-tags.select")
                        @slot("tagOptions", $categories)
                        @slot("tagTitle", __("main.category"))
                        @slot("tagName", "blog_edit_category_id")
                        @if(Route::is("admin.categories.edit"))
                            @slot("tagValue", $item->category_id)
                        @endif
                    @endcomponent

                    @component("adminpanel.components.html-tags.image")
                        @slot("tagTitle", __("main.image"))
                        @slot("tagName", "blog_edit_image")
                    @endcomponent
                </div>
            </div>
        </div>
    @endslot

    @slot("formScripts")
        @if(!Route::is("admin.blogs.edit"))
            <script>
                function blogEditModalJsFunction(id){
                    if(id !== null && id !== ""){
                        KTApp.blockPage();

                        var edit = "{{ route('admin.blogs.edit', ':id') }}",
                        edit_route = edit.replace(":id", id),

                        update = "{{ route('admin.blogs.update', ':id') }}",
                        update_route = update.replace(":id", id);
                        var form  = document.getElementById("blogEditFormID");
                            form.action = update_route;
                            form.reset();
                        $.get({
                            url:  edit_route,
                            success: function(res, xhr){
                                if(xhr == "success"){
                                    $("#blog_edit_name_en").val(res.payload.entity.name_en);
                                    if($("#blog_edit_name_ar").length > 0){
                                        $("#blog_edit_name_ar").val(res.payload.entity.name_ar);
                                    }
                                    if(res.payload.entity.data){
                                        setTimeout(() => {
                                            document.querySelector("#blog_edit_description_en").children[0].innerHTML = res.payload.entity.data.description_en ? res.payload.entity.data.description_en : '';
                                            if($("#blog_edit_description_ar").length > 0){
                                                document.querySelector("#blog_edit_description_ar").children[0].innerHTML = res.payload.entity.data.description_ar ? res.payload.entity.data.description_ar : '';
                                            }
                                        }, globalTimeOut);
                                    }
                                    $("#blog_edit_category_id").val(res.payload.entity.category_id);

                                    $("#holder_blog_edit_image .image-input-wrapper").css({"background-image": "url("+res.payload.entity.image+")"});
                                    toggleModalEdit("blog", form, res.payload.entity.id);
                                }else{
                                    errorMessage(res.payload);
                                }
                            },
                            error: function(res){
                                errorMessage(res);
                            },
                        });
                    }
                }
            </script>
        @elseif(Route::is("admin.blogs.edit"))
            <script>  </script>
        @endif
    @endslot
@endcomponent

