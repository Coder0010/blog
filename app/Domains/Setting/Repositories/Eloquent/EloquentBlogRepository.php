<?php

namespace App\Domains\Setting\Repositories\Eloquent;

use App\Core\Abstracts\EloquentRepository;
use App\Domains\Setting\Entities\Blog;
use App\Domains\Setting\Repositories\Contracts\BlogRepository;

class EloquentBlogRepository extends EloquentRepository implements BlogRepository
{
    protected $relations = ["category", "comments", "author", "editor"];

    /**
     * The Repository Entity.
     *
     * @return stdClass
     */
    public function entity()
    {
        return Blog::class;
    }
}
