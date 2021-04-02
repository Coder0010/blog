<?php

namespace App\Domains\Setting\Entities;

use Route;
use Carbon\Carbon;
use App\Core\Abstracts\Entity;
use App\Core\Services\MediaService;
use App\Domains\Auth\Entities\User;
use App\Domains\Auth\Entities\View;
use App\Domains\Auth\Entities\Comment;
use Illuminate\Database\Eloquent\Builder;
use App\Domains\General\Entities\Categories\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Entity
{
    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable   = [
        'name_en',
        'name_ar',
        'data',
        'category_id',
        'author_id',
        'editor_id',
        'order',
        'status',
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::retrieved(function ($entity) {
            // this observer working only at show blog ( front end ) with user permission of normal role
            if(auth()->check()){
                if (Route::is('blogsShow') && auth()->user()->hasAnyRole([config('system.roles.normal.id')])) {
                    $current_date = Carbon::today();
                    $entity_count = $entity->views()->whereUserId(auth()->user()->id)->whereBetween('viewed_at', [
                        $current_date->toDateString() . ' 00:00:00',
                        $current_date->toDateString() . ' 23:59:59',
                    ])->count();
                    if ($entity_count == 0) {
                        $entity->views()->create([
                            'user_id' => auth()->user()->id
                        ]);
                    }
                }
            }
        });
    }

    /**
     * category Relationship.
     *
     * @return belongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * author Relationship.
     *
     * @return belongsTo
     */
    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * editor Relationship.
     *
     * @return belongsTo
     */
    public function editor() : BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    /**
     * Get all of the product's views.
     */
    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    /**
     * comments Relationship.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy("created_at", "desc")->with('user');
    }

}
