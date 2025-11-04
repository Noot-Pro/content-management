---
title: Configuration
weight: 3
---

### Configuration

There is two different set of configuration, for filament, and for the frontend pages

## Filament Configuration

to configure the plugin Sky, you can pass the configuration to the plugin in `adminPanelProvider`

these all the available configuration, and their defaults values

```php
SpatieLaravelTranslatablePlugin::make()
    //If you don't use multi-language
    ->defaultLocales([config('app.locale')])
    // or if you have more
    ->defaultLocales(['en', 'pt']),

SkyPlugin::make()
    ->navigationGroupLabel('Sky')

    // uploading config
    ->uploadDisk()
    ->uploadDirectory()

    // the default models, by default Sky will read from the config file 'zeus-sky'.
    // but if you want to customize the models per panel, you can do it here 
    ->models([
        // ...
        'Tag' => \NootPro\ContentManagement\Models\Tag::class,
    ])

    // available tags
    ->tagTypes([
        'tag' => 'Tag',
        'category' => 'Category',
        'library' => 'Library',
        'faq' => 'Faq',
    ])

    // disable a Resource, if you dont use it, or want to replace them with your own resource
    ->postResource()
    ->pageResource()
    ->faqResource()
    ->libraryResource()
    ->tagResource()
    ->navigationResource()

    // hide a Resource, if you need to register them, but want to hide them from the sidebar navigation
    ->hideResources([
        FaqResource::class,
    ])

    // hide/show nav badges
    ->hideNavigationBadges(resource: NootPro\ContentManagement\Resources::CollectionResource)
    ->showNavigationBadges(resource: NootPro\ContentManagement\Resources::CollectionResource)

```

## Customize Filament Resources

you can customize all Sky resources icons and sorting by adding the following code to your `AppServiceProvider` boot method

```php
PostResource::navigationSort(100);
PostResource::navigationIcon('heroicon-o-home');
PostResource::navigationGroup('New Name');
```


### Show or Hide Badges

To show all navigation badges (default)
```
    ->showNavigationBadges()
```

To hide all navigation badges
```
    ->hideNavigationBadges()
```

This will hide only the CollectionResource navigation badge
```
    ->hideNavigationBadges(resource: NootPro\ContentManagement\Resources::CollectionResource)
```

This will show only the FormResource navigation badge
```
    ->hideNavigationBadges()
    ->showNavigationBadges(resource: NootPro\ContentManagement\Resources::CollectionResource)
```

available resources:

- FaqResource, 
- LibraryResource, 
- NavigationResource, 
- PageResource, 
- PostResource, 
- TagResource,

## Frontend Configuration

use the file `zeu-sky.php`, to customize the frontend, like the prefix, middleware and URI prefix for each content type.

to publish the configuration:

```bash
php artisan vendor:publish --tag=zeus-sky-config
```

and here is the config content:

```php
<?php

return [
    'domain' => null,

    /**
     * disable all sky frontend routes.
     */
    'headless' => false,
    
    /**
     * set the default path for the blog homepage.
     */
    'prefix' => 'sky',

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
    ],

    'parsers' => [
        \NootPro\ContentManagement\Classes\BoltParser::class,
    ],

    'recentPostsLimit' => 5,

    'searchResultHighlightCssClass' => 'highlight',

    'skipHighlightingTerms' => ['iframe'],

    'defaultFeaturedImage' => null,
    
    'editor' => \NootPro\ContentManagement\Editors\RichEditor::class,
];
```
