@component("adminpanel.components.modal-component")
    @slot("modalID", "blogCreateModalID")

    @slot("permission", "Create_Blog")

    @slot("formStructure")
        @include("{$domainAlias}::{$nameSpace}.{$crudName}._form._create_form")
    @endslot

    @slot("formErrors", [
        "blog_create_name_en",
        "blog_create_name_ar",
        "blog_create_description_en",
        "blog_create_description_ar",
        "blog_create_category_id",
        "blog_create_image",
    ])
@endcomponent
