<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use ValueError;

class DatePicker extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var string|null The initial date that is selected in the format YYYY-MM-DD */
    protected ?string $initialDate = null;

    /**
     * Create a new Date Picker element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#datepicker
     * @param string $actionId The action triggered when a menu option is selected
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'datepicker';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function initialDate(string $date): static
    {
        if (!preg_match('/^\\d{4}-\\d{2]-\\d{2}$/', $date)) {
            throw new ValueError('The initial date must be in YYYY-MM-DD format');
        }
        $this->initialDate = $date;

        return $this;
    }
}
