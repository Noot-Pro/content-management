<?php

namespace NootPro\ContentManagement\Concerns;

use Closure;

trait HasNavigationGroupLabel
{
    public function navigationGroupLabel(Closure | string $label): static
    {
        $this->navigationGroupLabel = $label;

        return $this;
    }

    public function getNavigationGroupLabel(): Closure | string
    {
        $value = $this->evaluate($this->navigationGroupLabel);

        return __($value);
    }
}
