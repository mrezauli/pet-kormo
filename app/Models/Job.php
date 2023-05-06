<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;

class Job extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'location_id', 'company_id', 'requirement_id', 'designation_id', 'grade_id', 'age_id',
        'title', 'short_description', 'full_description', 'job_nature', 'address', 'top_rated', 'count_of_post',
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
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the company that owns the Job
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the designation that owns the Job
     */
    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }

    /**
     * Get the grade that owns the Job
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * Get the age that owns the Job
     */
    public function age(): BelongsTo
    {
        return $this->belongsTo(Age::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }

    /**
     * The requirements that belong to the Job
     */
    public function requirements(): BelongsToMany
    {
        return $this->belongsToMany(Requirement::class);
    }
}
