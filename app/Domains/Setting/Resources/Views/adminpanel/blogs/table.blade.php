@component("adminpanel.components.table-component", [ "data" => $data ])
    @slot("tableSingularName", "blog")
    @slot("tablePluralName", "blogs")
    @slot("tableColumnsTitle",[
        "blog",
        "category",
        "author",
        "last_editor",
        "comments_count",
        "image",
    ])
    @slot("tableColumnsSearch")
        @component("adminpanel.components.html-tags.select")
            @slot("tagParentClass", "col-3")
            @slot("tagHideLabel", true)
            @slot("tagOptions", $categories)
            @slot("tagTitle", __("main.category"))
            @slot("tagClass", "search_input")
            @slot("tagName", "search_category")
            @slot("tagValue", request("search_category"))
        @endcomponent
    @endslot
    @slot("tableData")
        <tbody data-order-route="{{ route('admin.blogs.multi.order') }}">
            @foreach ($data as $item)
                <tr data-id="{{ $item->id }}">
                    <th scope="row"> <label class="checkbox checkbox-inline checkbox-primary"> <input type="checkbox" name="ids[]" value="{{ $item->id }}"> <span></span> </label> </th>
                    <td> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_en") }}'> {{ $item->name_en }} </span> @if(count(AppLanguages()) > 1) <hr> <span data-tooltip='kt-tooltip' data-original-title='{{ __("main.name_ar") }}'> {{ $item->name_ar }} </span> @endif</td>
                    <td> {{ optional($item->category)->name_val }} </td>
                    <td> {{ optional($item->author)->name }} </td>
                    <td> {{ optional($item->editor)->name }} </td>
                    <td> {{ count($item->comments) }} </td>
                    <td> <img src="{{ $item->getMainMedia() }}" width="50" height="70"> </td>
                    <td>
                        @if($item->trashed())
                            @component("adminpanel.components.buttons.restore-btn")
                                @slot("permission", "Restore_Blog")
                                @slot("message", __("main.blog") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.blogs.restore", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.destory-btn")
                                @slot("permission", "Destory_Blog")
                                @slot("message", __("main.blog") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.blogs.destroy", $item->id))
                            @endcomponent
                        @else
                            @component("adminpanel.components.buttons.show-btn")
                                @slot("permission", "Show_Blog")
                                @slot("route", route("blogsShow", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.status-btn")
                                @slot("permission", "Statu_Blog")
                                @slot("status", $item->status)
                                @slot("id", $item->id)
                                @slot("route", route("admin.blogs.changeStatus", $item->id))
                            @endcomponent

                            @component("adminpanel.components.buttons.edit-btn")
                                @slot("permission", "Edit_Blog")
                                @slot("buttonOnclickFunction", "blogEditModalJsFunction({$item->id})")
                            @endcomponent

                            @component("adminpanel.components.buttons.delete-btn")
                                @slot("permission", "Delete_Blog")
                                @slot("message", __("main.blog") ."[ {$item->name_en} ]" )
                                @slot("route", route("admin.blogs.delete", $item->id))
                            @endcomponent
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endslot
@endcomponent
