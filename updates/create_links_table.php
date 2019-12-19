<?php

declare(strict_types=1);

namespace DamianLewis\SocialMedia\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateLinksTable extends Migration
{
    public function up(): void
    {
        Schema::create('damianlewis_socialmedia_links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_blank_target')->default(false);
            $table->boolean('is_active')->default(false);
            $table->unsignedSmallInteger('sort_order')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('damianlewis_socialmedia_links');
    }
}
