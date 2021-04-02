<?php

namespace App\Domains\General\Http\Controllers\EndUser;

use DB;
use Session;
use Exception;
use App\Core\Abstracts\ResourceController;
use App\Domains\General\Entities\Categories\Category;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentCategoryRepository;

class EndUserGeneralDomainController extends ResourceController
{
    protected $domainAlias = "generals";

    protected $nameSpace = "enduser";

    public function categoriesIndex()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.categories.index", [
            "title"      => __("site.categories"),
            "sub_title"  => GetSettingTransByKey("navbar_trans_categories"),
            "categories" => (new EloquentCategoryRepository)->eloquentAll()->ordered()->active()->whereHas('blogs')->get()
        ]);
    }

    public function categoriesShow(Category $category)
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.categories.show", [
            "title"     => __("site.category"),
            "sub_title" => $category->name_val,
            "blogs"     => $category->blogs
        ]);
    }
}
