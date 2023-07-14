<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class DateTimePicker extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use LimitsFieldLength;

    /** @var int|null The initial date and time that are selected as a UNIX timestamp */
    protected ?int $initialDateTime = null;

    /**
     * Create a new Datetime Picker element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#datetimepicker
     * @param string $actionId The action triggered when a menu option is selected
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'datepicker';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function initialDateTime(int $ts): static
    {
        $this->initialDateTime = $ts;

        return $this;
    }
}
