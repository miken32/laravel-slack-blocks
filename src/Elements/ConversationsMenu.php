<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\Filter;

class ConversationsMenu extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var string|null A conversation ID that will be selected at initial load (ignored if $defaultToCurrentConversation is true) */
    protected ?string $initialConversation = null;

    /** @var bool Pre-populates the select menu with the conversation that the user was viewing when they opened the modal */
    protected bool $defaultToCurrentConversation = false;

    /** @var Filter|null A filter object that reduces the list of available conversations */
    protected ?Filter $filter = null;

    /** @var bool Whether the view_submission payload from the menu's parent view will contain a response_url. Only works with modals, not messages */
    protected bool $responseUrlEnabled = false;

    /**
     * Create a new Menu element listing workspace channels, IMs, and MPIMs visible to the current user
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#conversations_select
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'conversations_select';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function initialConversation(string $conv): static
    {
        $this->initialConversation = $conv;

        return $this;
    }

    public function defaultToCurrentConversation(bool $default = true): static
    {
        $this->defaultToCurrentConversation = $default;

        return $this;
    }

    public function filter(Filter $filter): static
    {
        $this->filter = $filter;

        return $this;
    }

    public function responseUrlEnabled(bool $enabled = true): static
    {
        $this->responseUrlEnabled = $enabled;

        return $this;
    }
}
