<?php

return [
    'domain' => null,

    /**
     * disable all content management frontend routes.
     */
    'headless' => false,

    /**
     * set the default path for the blog homepage.
     */
    'prefix' => '',

    'layout' => 'noot-pro-content-management::components.layouts.app',

    'theme' => 'default',

    'locales' => [
        'ar' => ['name' => 'العربية', 'native' => 'العربية', 'regional' => 'ar_AE', 'flag' => 'ae'],
        'en' => ['name' => 'English', 'native' => 'English', 'regional' => 'en_GB', 'flag' => 'gb'],
    ],

    /**
     * the middleware you want to apply on all the blog routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    'middleware' => ['web'],

    /**
     * URI prefix for each content type
     */
    'uri' => [
        'post' => 'post',
        'page' => 'page',
        'library' => 'library',
        'faq' => 'faq',
    ],

    /**
     * you can overwrite any model and use your own
     * you can also configure the model per panel in your panel provider using:
     * ->models([ ... ])
     */
    'models' => [
        'Faq' => \NootPro\ContentManagement\Models\Faq::class,
        'Post' => \NootPro\ContentManagement\Models\Post::class,
        'PostStatus' => \NootPro\ContentManagement\Models\PostStatus::class,
        'Tag' => \NootPro\ContentManagement\Models\Tag::class,
        'Library' => \NootPro\ContentManagement\Models\Library::class,
        'Navigation' => \NootPro\ContentManagement\Models\Navigation::class,
    ],

    'parsers' => [
        \NootPro\ContentManagement\Classes\BoltParser::class,
    ],

    'recentPostsLimit' => 5,

    'searchResultHighlightCssClass' => 'highlight',

    'skipHighlightingTerms' => ['iframe'],

    'defaultFeaturedImage' => null,

    /**
     * the default editor for pages and posts, Available:
     * \NootPro\ContentManagement\Editors\TipTapEditor::class,
     * \NootPro\ContentManagement\Editors\TinyEditor::class,
     * \NootPro\ContentManagement\Editors\MarkdownEditor::class,
     * \NootPro\ContentManagement\Editors\RichEditor::class,
     */
    'editor' => \NootPro\ContentManagement\Editors\RichEditor::class,
];
