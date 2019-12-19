<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia\Models;

use Model;
use October\Rain\Database\Builder;
use October\Rain\Database\Traits\Nullable;
use October\Rain\Database\Traits\Sortable;
use October\Rain\Database\Traits\Validation;
use System\Models\File;

class Link extends Model
{
    use Nullable;
    use Sortable;
    use Validation;

    public $table = 'damianlewis_socialmedia_links';

    public $rules = [
        'name' => 'required',
        'url' => 'url'
    ];

    public $attachOne = [
        'icon' => File::class
    ];

    protected $casts = [
        'is_blank_target' => 'boolean',
        'is_active' => 'boolean'
    ];

    protected $nullable = [
        'name',
        'url',
        'sort_order'
    ];

    /**
     * Select only the active links.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
