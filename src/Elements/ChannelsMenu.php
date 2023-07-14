<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class ChannelsMenu extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var string|null A channel ID that will be selected at initial load */
    protected ?string $initialChannel = null;

    /** @var bool Whether the view_submission payload from the menu's parent view will contain a response_url. Only works with modals, not messages */
    protected bool $responseUrlEnabled = false;

    /**
     * Create a new Menu element listing public workspace channels visible to the current user
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#channel_select
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'channels_select';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function initialChannel(string $channel): static
    {
        $this->initialChannel = $channel;

        return $this;
    }

    public function responseUrlEnabled(bool $enabled = true): static
    {
        $this->responseUrlEnabled = $enabled;

        return $this;
    }
}
