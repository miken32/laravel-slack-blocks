<?php

namespace NathanHeffley\LaravelSlackBlocks\Concerns;

trait HasInitialValue
{
    /** @var string|null The initial value shown in the input */
    protected ?string $initialValue = null;

    public function initialValue(string $val): static
    {
        $this->initialValue = $val;

        return $this;
    }
}
