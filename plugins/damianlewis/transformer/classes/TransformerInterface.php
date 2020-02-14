<?php

declare(strict_types=1);

namespace DamianLewis\Transformer\Classes;

use Model;

interface TransformerInterface
{
    /**
     * Transform the attributes of the given model.
     *
     * @param  Model  $item
     * @return array
     */
    public function transformItem(Model $item): array;
}
