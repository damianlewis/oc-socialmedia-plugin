<?php

declare(strict_types=1);

namespace DamianLewis\Transformer\Classes;

use Model;
use October\Rain\Database\Collection;

trait CanTransform
{
    /**
     * Transforms the given model or returns null.
     *
     * @param  Transformer  $transformer
     * @param  Model|null  $model
     * @return array|null
     */
    protected function transformItemOrNull(Transformer $transformer, ?Model $model): ?array
    {
        if (!$model instanceof Model) {
            return null;
        }

        return $transformer->transformItem($model);
    }

    /**
     * Transforms the given collection or returns null.
     *
     * @param  Transformer  $transformer
     * @param  Collection  $collection
     * @return array|null
     */
    protected function transformCollectionOrNull(Transformer $transformer, Collection $collection): ?array
    {
        if ($collection->count() === 0) {
            return null;
        }

        return $transformer->transformCollection($collection);
    }
}
