<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // PROJECTS
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('long_description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('tags')->nullable();
            $table->json('tech_stack')->nullable();
            $table->json('features')->nullable();
            $table->string('type')->default('fullstack');
            $table->string('role')->nullable();
            $table->string('duration')->nullable();
            $table->string('year')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('github_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // MESSAGES 
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // COMMENTS
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('message');
            $table->string('avatar_url')->nullable();
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
        });

        // SETTINGS
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text');
            $table->timestamps();
        });

        // Seed default settings
        $now = now();
        DB::table('settings')->insert([
            // Profil
            ['key' => 'name',          'value' => 'Shakilla Ragelia',            'type' => 'text',    'created_at' => $now, 'updated_at' => $now],
            ['key' => 'tagline',       'value' => 'Full Stack Developer & Pentester', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'bio',           'value' => 'Passionate full-stack web developer from Indonesia, building robust apps with PHP, Laravel & Vue.js.', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'photo',         'value' => null,                   'type' => 'image',   'created_at' => $now, 'updated_at' => $now],
            ['key' => 'cv_url',        'value' => null,                   'type' => 'file',    'created_at' => $now, 'updated_at' => $now],
            ['key' => 'location',      'value' => 'Indonesia 🇮🇩',        'type' => 'text',    'created_at' => $now, 'updated_at' => $now],
            ['key' => 'years_exp',     'value' => '2',                    'type' => 'text',    'created_at' => $now, 'updated_at' => $now],
            ['key' => 'available',     'value' => 'true',                 'type' => 'boolean', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'quote',         'value' => 'Security is not a product, but a process — and I build both.', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            // Kontak
            ['key' => 'email',         'value' => 'shakilla.ragelia25@gmail.com',       'type' => 'text',    'created_at' => $now, 'updated_at' => $now],
            ['key' => 'whatsapp',      'value' => '62812xxxxxxx',         'type' => 'text',    'created_at' => $now, 'updated_at' => $now],
            ['key' => 'whatsapp_msg',  'value' => 'Halo, saya ingin berdiskusi mengenai project', 'type' => 'text', 'created_at' => $now, 'updated_at' => $now],
            // Social
            ['key' => 'github',        'value' => 'https://github.com/shakillaragelia',    'type' => 'url', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'linkedin',      'value' => 'https://linkedin.com/in/shakillaragelia/', 'type' => 'url', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'instagram',     'value' => null,                   'type' => 'url',     'created_at' => $now, 'updated_at' => $now],
            ['key' => 'hackthebox',    'value' => null,                   'type' => 'url',     'created_at' => $now, 'updated_at' => $now],
            ['key' => 'tiktok',        'value' => null,                   'type' => 'url',     'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('projects');
    }
};
