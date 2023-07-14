<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use InvalidArgumentException;
use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\Option;
use NathanHeffley\LaravelSlackBlocks\Objects\OptionGroup;

class StaticMenu extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var Option|null An option object that exactly matches one of the returned options. It will be selected at initial load */
    protected ?Option $initialOption = null;

    /**
     * Create a new Menu element with static options
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#static_select
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     * @param array<Option>|null $options An array of option objects (one of $options or $optionGroups must be set)
     * @param array<OptionGroup>|null $optionGroups An array of option group objects  (one of $options or $optionGroups must be set)
     */
    public function __construct(
        protected string $actionId,
        protected ?array $options = null,
        protected ?array $optionGroups = null,
    )
    {
        $this->type = 'static_select';
        if (
            (is_null($this->options) && is_null($this->optionGroups))
            || (!is_null($this->options) && !is_null($this->optionGroups))
        ) {
            throw new InvalidArgumentException('Exactly one of $options or $optionGroups must be set');
        }
        if (is_array($this->options)) {
            $this->options = array_filter(
                $this->options,
                fn ($v) => $v instanceof Option
            );
        }
        if (is_array($this->optionGroups)) {
            $this->optionGroups = array_filter(
                $this->optionGroups,
                fn ($v) => $v instanceof OptionGroup
            );
        }
        $this->validateFieldLengths([
            'action_id' => 255,
            'options' => 100,
            'option_groups' => 100,
        ]);
    }

    public function initialOption(Option $option): static
    {
        $this->initialOption = $option;

        return $this;
    }
}
