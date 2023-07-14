<?php

namespace NathanHeffley\LaravelSlackBlocks\Concerns;

use NathanHeffley\LaravelSlackBlocks\Objects\PlainText;

trait HasPlaceholder
{
    use LimitsFieldLength;

    /** @var PlainText|null A Text object that defines the placeholder text shown on the input */
    protected ?PlainText $placeholder = null;

    /**
     * Sets the value of the placeholder field
     *
     * @param string|PlainText $text
     * @return $this
     */
    public function placeholder(string|PlainText $text): static
    {
        $this->placeholder = is_string($text) ? new PlainText($text) : $text;
        $this->validateFieldLengths(['placeholder' => 150]);

        return $this;
    }
}
