<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia\Updates;

use DamianLewis\SocialMedia\Models\Link;
use Seeder;

class SeedDummyLinks extends Seeder
{
    public function run()
    {
        factory(Link::class, 2)->create();
        factory(Link::class, 2)->states(['blank', 'active'])->create();
    }
}