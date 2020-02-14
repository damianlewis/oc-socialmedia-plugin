<?php

declare(strict_types=1);

namespace DamianLewis\Transformer;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails(): array
    {
        return [
            'name' => 'Transformer',
            'description' => 'Transformer package for transforming model data.',
            'author' => 'Damian Lewis',
            'icon' => 'icon-refresh'
        ];
    }
}
