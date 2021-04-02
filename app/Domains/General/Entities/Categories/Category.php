<?php

namespace App\Domains\General\Entities\Categories;

use Route;
use Carbon\Carbon;
use App\Core\Abstracts\Entity;
use App\Domains\Auth\Entities\View;
use App\Domains\Setting\Entities\Blog;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Entity
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
        'parent_id',
        'child_id',
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
            if(auth()->check()){
                if (Route::is("categoriesShow") && !auth()->user()->hasAnyRole([config('system.roles.normal.id')])) {
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
     * fetch data.
     *
     */
    public function entityFetchData(array $relations = [])
    {
        return $this->with($relations)->whereNull('parent_id')->whereNull('child_id');
    }

    /**
     * Get all of the product's views.
     */
    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    /**
     * blogs Relationship.
     *
     * @return HasMany
     */
    public function blogs() : HasMany
    {
        return $this->hasMany(Blog::class);
    }
}
