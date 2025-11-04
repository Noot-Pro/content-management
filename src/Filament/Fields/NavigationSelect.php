<?php

namespace NootPro\ContentManagement\Filament\Fields;

use Filament\Forms\Components\Select;
use NootPro\ContentManagement\ContentManagementPlugin;

class NavigationSelect extends Select
{
    protected string $optionValueProperty = 'id';

    protected function setUp(): void
    {
        parent::setUp();

        $this->options(function (NavigationSelect $component) {
            return ContentManagementPlugin::get()->getModel('Navigation')::pluck('name', $component->getOptionValueProperty());
        });
    }

    public function getOptionValueProperty(): string
    {
        return $this->optionValueProperty;
    }
}
