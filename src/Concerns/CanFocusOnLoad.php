<?php

namespace NathanHeffley\LaravelSlackBlocks\Concerns;

trait CanFocusOnLoad
{
    /** @var bool Whether the element will be set to autofocus within the view */
    protected bool $focusOnLoad = false;

    /**
     * Set the focus_on_load field; this should only be set on one element per block
     *
     * @param bool $focus
     * @return $this
     */
    public function focusOnLoad(bool $focus = true): static
    {
        $this->focusOnLoad = $focus;

        return $this;
    }
}
