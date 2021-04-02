<?php

namespace App\Domains\Setting\Entities;

use File;
use App\Core\Abstracts\Entity;
use App\Core\Services\MediaService;

class Setting extends Entity
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'key',
        'data',
    ];

}
