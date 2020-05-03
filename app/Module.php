<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RecursiveRelationships\Traits\HasRecursiveRelationships;
use Sluggable\Traits\Sluggable;

class Module extends Model
{
    use SoftDeletes, Sluggable, HasRecursiveRelationships;

    protected $fillable = [
        'name', 'alias', 'icon'
    ];

    public function getParentKeyName()
    {
        return 'module_id';
    }
}
