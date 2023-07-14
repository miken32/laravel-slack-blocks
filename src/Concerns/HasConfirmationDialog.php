<?php

namespace NathanHeffley\LaravelSlackBlocks\Concerns;

use NathanHeffley\LaravelSlackBlocks\Objects\ConfirmationDialog;

trait HasConfirmationDialog
{
    /** @var ConfirmationDialog|null An optional confirmation dialog shown after the button is clicked */
    protected ?ConfirmationDialog $confirm = null;

    public function confirm(ConfirmationDialog $dialog): static
    {
        $this->confirm = $dialog;

        return $this;
    }

}
