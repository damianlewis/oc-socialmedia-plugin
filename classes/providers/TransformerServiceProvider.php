<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia\Classes\Providers;

use DamianLewis\SocialMedia\Classes\Transformers\LinksTransformer;
use October\Rain\Support\ServiceProvider;

class TransformerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LinksTransformer::class, function () {
            return new LinksTransformer();
        });
    }
}