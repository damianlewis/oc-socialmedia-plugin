<?php

declare(strict_types=1);

namespace DamianLewis\Transformer\Classes\Transformers;

use DamianLewis\Transformer\Classes\Transformer;
use DamianLewis\Transformer\Classes\TransformerInterface;
use Model;
use System\Models\File;

class FileTransformer extends Transformer implements TransformerInterface
{
    /**
     * Transforms the given file model to include the only the file path and title attributes.
     *
     * @param  Model  $item
     * @return array
     */
    public function transformItem(Model $item): array
    {
        if (!$item instanceof File) {
            return [];
        }

        return [
            'path' => $item->getPath(),
            'title' => $item->title
        ];
    }
}
