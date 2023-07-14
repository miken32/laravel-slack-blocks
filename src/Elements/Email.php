<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasDispatchConfig;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasInitialValue;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class Email extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasDispatchConfig;
    use HasInitialValue;
    use HasPlaceholder;
    use LimitsFieldLength;

    /**
     * Create a new Email element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#email
     * @param string $actionId The action triggered when a menu option is selected
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'email_text_input';
        $this->validateFieldLengths(['action_id' => 255]);
    }
}
