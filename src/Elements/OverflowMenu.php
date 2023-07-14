<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\Option;

class OverflowMenu extends InteractiveElementBase implements SlackElementContract
{
    use HasConfirmationDialog;
    use LimitsFieldLength;

    /**
     * Create a new Overflow Menu element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#overflow
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     * @param array<Option> $options An array of option objects
     */
    public function __construct(protected string $actionId, protected array $options)
    {
        $this->type = 'overflow';
        $this->options = array_filter(
            $this->options,
            fn ($v) => $v instanceof Option
        );
        $this->validateFieldLengths([
            'action_id' => 255,
            'options' => 5,
        ]);
    }
}
