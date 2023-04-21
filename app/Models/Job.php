<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Category;
use App\Models\Location;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\File;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'location_id', 'company_id',
        'title', 'short_description', 'full_description', 'requirements', 'job_nature', 'address', 'top_rated', 'salary'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf'])
            ->acceptsFile(function (File $file) {
                return $file->mimeType === 'application/pdf';
            });
    }

    /**
     * Get the location that owns the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the company that owns the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }
}