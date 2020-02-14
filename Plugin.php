<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia;

use App;
use Backend;
use DamianLewis\SocialMedia\Classes\Providers\TransformerServiceProvider;
use DamianLewis\SocialMedia\Components\Links;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

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

    public function boot()
    {
        App::register(TransformerServiceProvider::class);
    }

    public function registerComponents(): array
    {
        return [
            Links::class => 'socialMediaLinks'
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
                'category' => SettingsManager::CATEGORY_MYSETTINGS,
                'permissions' => ['damianlewis.socialmedia.access_links']
            ]
        ];
    }
}
