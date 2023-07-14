<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\Option;

class CheckboxGroup extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use LimitsFieldLength;

    /** @var array<Option>|null An array of option objects that exactly matches one or more of the options within $options. These will be selected at initial load */
    protected ?array $initialOptions = null;

    /**
     * Create a new Checkbox Group element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#checkboxes
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     * @param array<Option> $options An array of option objects
     */
    public function __construct(protected string $actionId, protected array $options)
    {
        $this->type = 'checkboxes';
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
