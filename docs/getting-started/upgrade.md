---
title: Upgrading
weight: 100
---


## upgrade to v4.0

- the editor `TipTapEditor` has been deleted and replaced with `RichEditor`

### using an enum for the status:

the namespace for the `PostStatus` changed from `LaraZeus\\Sky\\Models\\PostStatus` to `LaraZeus\\Sky\\Enums\\PostStatus`

### Configuration:

Add to your config file:

```php
'enums' => [
    'PostStatus' => PostStatus::class,
],
```

and remove the key `PostStatus` from the `models` array.

the same for the panel configuration:

```php
SkyPlugin::make()
    ->models([
        'PostStatus' => \App\Enums\Sky\PostStatus::class, // [tl! --]
    ])

    ->enums([ // [tl! ++]
        'PostStatus' => \App\Enums\Sky\PostStatus::class, // [tl! ++]
    ]) // [tl! ++]
```