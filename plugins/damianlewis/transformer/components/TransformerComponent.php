<?php

declare(strict_types=1);

namespace DamianLewis\Transformer\Components;

use Cms\Classes\ComponentBase;
use DamianLewis\Transformer\Classes\Transformer;
use Model;
use October\Rain\Database\Collection;

abstract class TransformerComponent extends ComponentBase
{
    /**
     * @var Transformer
     */
    protected $transformer;

    /**
     * Returns the transformed model.
     *
     * @param  Model  $model
     * @return array
     */
    protected function transformItem(Model $model): array
    {
        return $this->transformer->transformItem($model);
    }

    /**
     * Returns the transformed collection.
     *
     * @param  Collection  $collection
     * @return array
     */
    protected function transformCollection(Collection $collection): array
    {
        return $this->transformer->transformCollection($collection);
    }
}