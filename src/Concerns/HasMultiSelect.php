<?php

namespace NathanHeffley\LaravelSlackBlocks\Concerns;

use ValueError;

trait HasMultiSelect
{
    /** @var int The maximum number of items that can be selected in the menu */
    protected int $maxSelectedItems = 1;

    public function maxSelectedItems(int $max): static
    {
        if ($max < 1) {
            throw new ValueError('The max selected items must be greater than zero');
        }
        $this->maxSelectedItems = $max;

        return $this;
    }
}
