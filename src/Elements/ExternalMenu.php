<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasMultiSelect;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\Option;
use ValueError;

class ExternalMenu extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasMultiSelect;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var int The fewest number of characters in the typeahead field required before dispatch */
    protected int $minQueryLength = 3;

    /** @var Option|null An option object that exactly matches one of the returned options. It will be selected at initial load */
    protected ?Option $initialOption = null;

    /**
     * Create a new Menu element with options retrieved from an external source
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#external_select
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'external_select';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function minQueryLength(int $len): static
    {
        if ($len < 3) {
            throw new ValueError('The min query length must be greater than two');
        }
        $this->minQueryLength = $len;

        return $this;
    }

    public function initialOption(Option $option): static
    {
        $this->initialOption = $option;

        return $this;
    }
}
