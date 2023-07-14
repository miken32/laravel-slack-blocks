<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class TimePicker extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var string|null The initial time that is selected in the format HH:mm (24 hr) */
    protected ?string $initialTime = null;

    /** @var string|null A string in IANA format (e.g. America/Vancouver) */
    protected ?string $timezone = null;

    /**
     * Create a new Time Picker element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#timepicker
     * @param string $actionId The action triggered when a menu option is selected
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'timepicker';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function initialTime(string $time): static
    {
        if (!preg_match('/^(?:[01]\\d|2[0-3]):[0-5]\\d$/', $time)) {
            throw new \ValueError('The initial time must be in 24-hour HH:MM format');
        }
        $this->initialTime = $time;

        return $this;
    }

    public function timezone(string $zone): static
    {
        $this->timezone = $zone;

        return $this;
    }
}
