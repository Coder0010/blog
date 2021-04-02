<?php

namespace App\Domains\Setting\Http\Controllers\EndUser;

use DB;
use Session;
use Exception;
use App\Domains\Setting\Entities\Blog;
use App\Core\Abstracts\ResourceController;
use App\Domains\Auth\Http\Requests\EndUser\BlogRequest;
use App\Domains\Setting\Repositories\Eloquent\EloquentBlogRepository;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentCategoryRepository;

class EndUserSettingDomainController extends ResourceController
{
    protected $domainAlias = "settings";

    protected $nameSpace = "enduser";

    public function blogsIndex()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.blogs.index", [
            "title"             => GetSettingTransByKey("navbar_trans_blogs"),
            "sub_title"         => __("site.our_recent_blog_entries"),
            "blogs"             => (new EloquentBlogRepository)->eloquentAll()->ordered()->active()->get(),
            "viewed_blogs"      => (new EloquentBlogRepository)->eloquentAll()->ordered()->active()->viewedByLoggedUser()->get(),
            "viewed_categories" => (new EloquentCategoryRepository)->eloquentAll()->ordered()->active()->viewedByLoggedUser()->get()
        ]);
    }

    public function blogsShow(Blog $blog)
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.blogs.show", [
            "title"       => __("site.blog"),
            "sub_title"   => $blog->name_val,
            "item"        => $blog
        ]);
    }

    public function blogComments()
    {
        $comments = (new EloquentBlogRepository)->eloquentFind(request('blog'))->comments;
        return $this->userJsonResponse($comments);

    }

}
