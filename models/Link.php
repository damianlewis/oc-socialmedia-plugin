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

    /**
     * The attributes on which the links can be ordered.
     *
     * @var array
     */
    public static $orderByOptions = [
        'sort_order' => 'Sort order',
        'created_at' => 'Created date',
        'updated_at' => 'Updated date',
        'name' => 'Name'
    ];

    /**
     * The direction the links can be ordered.
     *
     * @var array
     */
    public static $orderDirectionOptions = [
        'asc' => 'Ascending',
        'desc' => 'Descending'
    ];

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
        'is_visible' => 'boolean'
    ];

    protected $nullable = [
        'name',
        'url',
        'sort_order'
    ];

    /**
     * Select only the visible links.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    /**
     * Returns an ordered collection of links for the frontend.
     *
     * @param  Builder  $query
     * @param  array  $options
     * @return Builder
     */
    public function scopeFrontEndCollection(Builder $query, array $options = []): Builder
    {
        /**
         * @var string $orderBy
         * @var string $orderDirection
         */
        extract(array_merge([
            'orderBy' => 'sort_order',
            'orderDirection' => 'asc'
        ], $options));

        $sortOrderByValid = in_array($orderBy, array_keys(self::$orderByOptions));
        $sortOrderDirectionValid = in_array($orderDirection, array_keys(self::$orderDirectionOptions));

        return $query
            ->visible()
            ->when($sortOrderByValid && $sortOrderDirectionValid, function ($query) use ($orderBy, $orderDirection) {
                return $query->orderBy($orderBy, $orderDirection);
            });
    }
}
