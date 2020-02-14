<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia\Classes\Transformers;

use DamianLewis\SocialMedia\Models\Link;
use DamianLewis\Transformer\Classes\CanTransform;
use DamianLewis\Transformer\Classes\Transformer;
use DamianLewis\Transformer\Classes\TransformerInterface;
use DamianLewis\Transformer\Classes\Transformers\FileTransformer;
use Model;

class LinksTransformer extends Transformer implements TransformerInterface
{
    use CanTransform;

    /**
     * @inheritDoc
     */
    public function transformItem(Model $item): array
    {
        if (!$item instanceof Link) {
            return [];
        }

        $fileTransformer = resolve(FileTransformer::class);

        $data = $item->only([
            'name',
            'url',
        ]);

        $data = array_merge($data, [
            'icon' => $this->transformItemOrNull($fileTransformer, $item->icon),
            'useBlankTarget' => $item->is_blank_target
        ]);

        return $data;
    }
}