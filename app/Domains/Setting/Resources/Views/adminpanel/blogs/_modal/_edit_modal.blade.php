@component("adminpanel.components.modal-component")
    @slot("modalID", "blogEditModalID")

    @slot("permission", "Edit_Blog")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._edit_form")
    @endslot

    @slot("formErrors", [
        "blog_edit_name_en",
        "blog_edit_name_ar",
        "blog_edit_description_en",
        "blog_edit_description_ar",
        "blog_edit_category_id",
        "blog_edit_image",
    ])
@endcomponent
