<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasDispatchConfig;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasInitialValue;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class Url extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasDispatchConfig;
    use HasInitialValue;
    use HasPlaceholder;
    use LimitsFieldLength;

    /**
     * Create a new Url element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#url
     * @param string $actionId The action triggered when a menu option is selected
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'url_text_input';
        $this->validateFieldLengths(['action_id' => 255]);
    }
}
