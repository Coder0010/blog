<?php

namespace App\Domains\Setting\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class AdminBlogsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->isMethod("post")) {
            return [
                "blog_create_name_en"        => config("rules.name_en")."|unique:blogs,name_en",
                "blog_create_name_ar"        => config("rules.name_ar")."|unique:blogs,name_ar",
                "blog_create_description_en" => config("rules.description_en"),
                "blog_create_description_ar" => config("rules.description_ar"),
                "blog_create_category_id"    => config("rules.category_id"),
                "blog_create_image"          => config("rules.image"),
            ];
        }elseif(request()->isMethod("patch")){
            return [
                "blog_edit_name_en"        => config("rules.name_en")."|unique:blogs,name_en,".request("blog"),
                "blog_edit_name_ar"        => config("rules.name_ar")."|unique:blogs,name_ar,".request("blog"),
                "blog_edit_description_en" => config("rules.edit_description_en"),
                "blog_edit_description_ar" => config("rules.edit_description_ar"),
                "blog_edit_category_id"    => config("rules.category_id"),
                "blog_edit_image"          => config("rules.edit_image"),
            ];
        }elseif(request()->isMethod("delete")){
            return [

            ];
        }

    }

}
