<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia;

use Backend;
use DamianLewis\SocialMedia\Components\Links;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails(): array
    {
        return [
            'name' => 'Social Media',
            'description' => 'Manage a list of social media links.',
            'author' => 'Damian Lewis',
            'icon' => 'icon-users'
        ];
    }

    public function registerComponents(): array
    {
        return [
            Links::class => 'links'
        ];
    }

    public function registerPermissions(): array
    {
        return [
            'damianlewis.socialmedia.access_links' => [
                'tab' => 'Social Media',
                'label' => 'Manage the social media links.'
            ]
        ];
    }

    public function registerSettings(): array
    {
        return [
            'links' => [
                'label' => 'Social Media Links',
                'description' => 'Manage the social media links.',
                'icon' => 'icon-link',
                'url' => Backend::url('damianlewis/socialmedia/links'),
                'permissions' => ['damianlewis.socialmedia.access_links'],
                'order' => 999
            ]
        ];
    }
}
