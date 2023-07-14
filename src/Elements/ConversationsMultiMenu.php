<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasMultiSelect;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;
use NathanHeffley\LaravelSlackBlocks\Objects\Filter;

class ConversationsMultiMenu extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasMultiSelect;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var array<string>|null A list of conversation IDs that will be selected at initial load (ignored if $defaultToCurrentConversation is true) */
    protected ?array $initialConversations = null;

    /** @var bool Pre-populates the select menu with the conversation that the user was viewing when they opened the modal */
    protected bool $defaultToCurrentConversation = false;

    /** @var Filter|null A filter object that reduces the list of available conversations */
    protected ?Filter $filter = null;

    /**
     * Create a new Menu element listing workspace channels, IMs, and MPIMs visible to the current user
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#conversations_multi_select
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'multi_conversations_select';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function initialConversations(array $conv): static
    {
        $this->initialConversations = array_filter(
            $conv,
            fn ($v) => is_string($v)
        );

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

}
