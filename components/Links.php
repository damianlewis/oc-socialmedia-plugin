<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia\Components;

use Closure;
use Cms\Classes\ComponentBase;
use DamianLewis\SocialMedia\Models\Link;
use October\Rain\Database\Collection;

class Links extends ComponentBase
{
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
                'options' => [
                    'sort_order' => 'Sort Order',
                    'created_at' => 'Created Date',
                    'updated_at' => 'Updated Date',
                    'name' => 'Name'
                ],
                'default' => 'sort_order'
            ],
            'orderDirection' => [
                'title' => 'Order direction',
                'type' => 'dropdown',
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'asc'
            ],
            'active' => [
                'title' => 'Active',
                'description' => 'Only display active links.',
                'type' => 'checkbox',
                'default' => true
            ]
        ];
    }

    public function onRun(): void
    {
        $this->page['linkList'] = array_map(
            $this->transformLinks(['name', 'url', 'icon', 'is_blank_target']),
            $this->getLinks()->all()
        );
    }

    /**
     * Returns an ordered collection of links.
     *
     * @return Collection
     */
    protected function getLinks(): Collection
    {
        return Link::query()
            ->when($this->property('active'), function ($query) {
                return $query->active();
            })
            ->orderBy($this->property('orderBy'), $this->property('orderDirection'))
            ->get();
    }

    /**
     * Returns only the link data required by the frontend.
     *
     * @param  array  $data  An array of model attributes and relations.
     * @return Closure
     */
    protected function transformLinks(array $data): Closure
    {
        return function (Link $link) use ($data) {
            return $link->only($data);
        };
    }
}
