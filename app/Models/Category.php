<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yemenpoint\FilamentTree\HasTree;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    use HasTree;

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('children')->orderBy('order');
    }

    protected $fillable = [
        'name',
    ];
}
