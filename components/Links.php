<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia\Components;

use Closure;
use Cms\Classes\ComponentBase;
use DamianLewis\SocialMedia\Models\Link;
use October\Rain\Database\Collection;

class Links extends ComponentBase
{
    /**
     * @var Collection
     */
    private $links;

    public function componentDetails(): array
    {
        return [
            'name' => 'Links',
            'description' => 'Get a collection of social media links.'
        ];
    }

    public function defineProperties(): array
    {
        return [
            'orderBy' => [
                'title' => 'Order by',
                'description' => 'The attribute to order the links by.',
                'type' => 'dropdown',
                'default' => 'sort_order'
            ],
            'orderDirection' => [
                'title' => 'Order direction',
                'type' => 'dropdown',
                'default' => 'asc'
            ]
        ];
    }

    /**
     * Returns an array of transformed links for consumption by the frontend.
     *
     * @return array The transformed collection.
     */
    public function collection(): array
    {
        if (!$this->isAvailable()) {
            return [];
        }

        return $this->transformCollection($this->links);
    }

    /**
     * Returns true if a collection of links has been fetched from the database.
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        if ($this->links === null) {
            return false;
        }

        if ($this->links->count() > 0) {
            return true;
        }

        return false;
    }

    public function onRun(): void
    {
        $this->links = $this->getLinks();
    }

    /**
     * Returns an array of order by options.
     *
     * @return array
     */
    public function getOrderByOptions(): array
    {
        return Link::$orderByOptions;
    }

    /**
     * Returns an array of order direction options.
     *
     * @return array
     */
    public function getOrderDirectionOptions(): array
    {
        return Link::$orderDirectionOptions;
    }

    /**
     * Transforms a links collection into the data required by the frontend.
     *
     * @param  Collection  $links
     * @return array
     */
    protected function transformCollection(Collection $links): array
    {
        return array_map(
            $this->transformItem(),
            $links->all()
        );
    }

    /**
     * Transforms a link model into the data required by the frontend.
     *
     * @return Closure
     */
    protected function transformItem(): Closure
    {
        return function (Link $link) {
            $data = $link->only([
                'name',
                'url',
                'icon'
            ]);

            return array_merge($data, [
                'useBlankTarget' => $link->is_blank_target
            ]);
        };
    }

    /**
     * Returns an ordered collection of links.
     *
     * @return Collection
     */
    protected function getLinks(): Collection
    {
        $options = [
            'orderBy' => $this->property('orderBy'),
            'orderDirection' => $this->property('orderDirection')
        ];

        return Link::frontEndCollection($options)->get();
    }
}
