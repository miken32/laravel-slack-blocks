<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\Option;

class RadioGroup extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use LimitsFieldLength;

    /** @var array<Option>|null $initialOptions An array of option objects that exactly matches one or more of the returned options. These will be selected at initial load  */
    protected ?array $initialOptions = null;

    /**
     * Create a new Radio Button Group element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#radio
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     * @param array<Option> $options An array of option objects
     */
    public function __construct(protected string $actionId, protected array $options)
    {
        $this->type = 'radio_buttons';
        $this->options = array_filter(
            $this->options,
            fn ($v) => $v instanceof Option
        );
        $this->validateFieldLengths([
            'action_id' => 255,
            'options' => 10,
        ]);
    }

    public function initialOptions(array $options): static
    {
        $this->initialOptions = array_filter(
            $options,
            fn ($v) => $v instanceof Option
        );

        return $this;
    }
}
