<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\PlainText;

class Input extends BlockBase implements SlackBlockContract
{
    use LimitsFieldLength;

    /** @var PlainText A label that appears above an input element */
    protected PlainText $label;

    /** @var bool If true, the use of elements in this block should dispatch a block_actions payload */
    protected bool $dispatchAction = false;

    /** @var bool If true, the input element may be empty when a user submits the modal */
    protected bool $optional = false;

    /** @var ?PlainText An optional hint that appears below an input element in a lighter grey */
    protected ?PlainText $hint = null;

    /**
     * Create a new Input block
     *
     * @see https://api.slack.com/reference/block-kit/blocks#input
     * @param string $label The text of the label Text object
     * @param SlackElementContract $element An input element
     */
    public function __construct(
        string $label,
        protected SlackElementContract $element,
    )
    {
        $this->type = 'input';
        $this->$label = new PlainText($label);
        $this->validateFieldLengths(['label' => 2000]);
    }

    public function dispatchAction(bool $dispatch = true): static
    {
        $this->dispatchAction = $dispatch;

        return $this;
    }

    public function optional(bool $optional = true): static
    {
        $this->optional = $optional;

        return $this;
    }

    public function hint(string|PlainText $text): static
    {
        $this->hint = is_string($text) ? new PlainText($text) : $text;
        $this->validateFieldLengths(['hint' => 2000]);

        return $this;
    }
}
