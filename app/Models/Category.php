<?php

namespace App\Models;

use Yemenpoint\FilamentTree\HasTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SolutionForest\FilamentTree\Concern\ModelTree;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    use HasTree;

    function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with("children")->orderBy("order");
    }

    protected $fillable = [
        'name',
    ];
}
