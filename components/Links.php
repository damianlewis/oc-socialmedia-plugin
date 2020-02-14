<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia\Components;

use DamianLewis\SocialMedia\Classes\Transformers\LinksTransformer;
use DamianLewis\SocialMedia\Models\Link;
use DamianLewis\Transformer\Components\TransformerComponent;
use October\Rain\Database\Collection;

class Links extends TransformerComponent
{
    /**
     * @var array
     */
    public $links;

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

    public function init(): void
    {
        $this->transformer = resolve(LinksTransformer::class);
    }

    public function onRun(): void
    {
        $links = $this->getLinks();

        $this->page['links'] = $this->links = $this->transformCollection($links);
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
