<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use NootPro\ContentManagement\ContentManagementPlugin;

class SkySeeder extends Seeder
{
    public function run(): void
    {
        ContentManagementPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'laravel', 'ar' => 'لارافل'], 'type' => 'category']);
        ContentManagementPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'talks', 'ar' => 'اخبار'], 'type' => 'category']);
        ContentManagementPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'dev', 'ar' => 'تطوير'], 'type' => 'category']);

        ContentManagementPlugin::get()->getModel('Post')::factory()
            ->count(8)
            ->create();

        foreach (ContentManagementPlugin::get()->getModel('Post')::all() as $post) {
            $random_tags = ContentManagementPlugin::get()->getModel('Tag')::all()->random(1)->first()->name;
            $post->syncTagsWithType([$random_tags], 'category');
        }

        ContentManagementPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'support docs', 'ar' => 'الدعم الفني'], 'type' => 'library']);
        ContentManagementPlugin::get()->getModel('Tag')::create(['name' => ['en' => 'how to', 'ar' => 'كيف'], 'type' => 'library']);

        ContentManagementPlugin::get()->getModel('Library')::factory()
            ->count(8)
            ->create();

        foreach (ContentManagementPlugin::get()->getModel('Library')::all() as $library) {
            $random_tags = ContentManagementPlugin::get()->getModel('Tag')::getWithType('library')->random(1)->first()->name;
            $library->syncTagsWithType([$random_tags], 'library');
        }
    }
}
