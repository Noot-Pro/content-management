<?php

namespace LaraZeus\Sky;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Support\Concerns\EvaluatesClosures;
use Illuminate\Support\Str;
use LaraZeus\Core\Concerns\CanGloballySearch;
use LaraZeus\Core\Concerns\CanStickyActions;
use LaraZeus\Core\Concerns\HasModels;
use LaraZeus\Core\Concerns\HasNavigationGroupLabel;
use LaraZeus\Core\Concerns\CanHideResources;
use LaraZeus\Core\Concerns\HasNavigationBadges;
use LaraZeus\Core\Concerns\HasUploads;
use LaraZeus\Core\Concerns\CanDisableResources;

trait Configuration
{
    use CanGloballySearch;
    use EvaluatesClosures;
    use HasModels;
    use HasNavigationGroupLabel;
    use CanHideResources;
    use CanStickyActions;
    use HasNavigationBadges;
    use HasUploads;
    use CanDisableResources;

    protected Closure | string $navigationGroupLabel = 'Sky';

    protected ?array $libraryTypes = [
        'FILE' => 'File',
        'IMAGE' => 'Image',
        'VIDEO' => 'Video',
    ];

    protected ?array $tagTypes = [
        'tag' => 'Tag',
        'category' => 'Category',
        'library' => 'Library',
        'faq' => 'Faq',
    ];

    protected array $itemTypes = [];

    protected array | Closure $extraFields = [];

    protected Closure | string | null $routeNamePrefix = null;

    private ?array $translatedTagTypes = null;

    private ?array $translatedLibraryTypes = null;

    public static function getDefaultModelsToMerge():array
    {
        return config('zeus-sky.models');
    }

    public function libraryTypes(array $types): static
    {
        $this->libraryTypes = $types;

        return $this;
    }

    public function getLibraryTypes(): ?array
    {
        if ($this->translatedLibraryTypes === null && $this->libraryTypes && function_exists('__')) {
            $this->translatedLibraryTypes = array_map('__', $this->libraryTypes);
        }

        return $this->translatedLibraryTypes ?? $this->libraryTypes;
    }

    public function tagTypes(array $types): static
    {
        $this->tagTypes = $types;

        return $this;
    }

    public function getTagTypes(): ?array
    {
        if ($this->translatedTagTypes === null && $this->tagTypes && function_exists('__')) {
            $this->translatedTagTypes = array_map('__', $this->tagTypes);
        }

        return $this->translatedTagTypes ?? $this->tagTypes;
    }

    public function itemType(string $name, array | Closure $fields, ?string $slug = null): static
    {
        $this->itemTypes[$slug ?? Str::slug($name)] = [
            'name' => $name,
            'fields' => $fields,
        ];

        return $this;
    }

    public function withExtraFields(array | Closure $schema): static
    {
        $this->extraFields = $schema;

        return $this;
    }

    public function getExtraFields(): array | Closure
    {
        return $this->extraFields;
    }

    public function getItemTypes(): array
    {
        return array_merge(
            [
                'external-link' => [
                    'name' => __('zeus-sky::filament-navigation.attributes.external-link'),
                    'fields' => [
                        TextInput::make('url')
                            ->label(__('zeus-sky::filament-navigation.attributes.url'))
                            ->required(),
                        Select::make('target')
                            ->label(__('zeus-sky::filament-navigation.attributes.target'))
                            ->options([
                                '' => __('zeus-sky::filament-navigation.select-options.same-tab'),
                                '_blank' => __('zeus-sky::filament-navigation.select-options.new-tab'),
                            ])
                            ->default('')
                            ->selectablePlaceholder(false),
                    ],
                ],
            ],
            $this->itemTypes
        );
    }

    public function routeNamePrefix(Closure | string | null $prefix): static
    {
        $this->routeNamePrefix = $prefix;

        return $this;
    }

    public function getRouteNamePrefix(): Closure | string | null
    {
        return $this->evaluate($this->routeNamePrefix);
    }
}
