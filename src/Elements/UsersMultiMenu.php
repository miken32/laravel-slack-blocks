<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasMultiSelect;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class UsersMultiMenu extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasMultiSelect;
    use HasPlaceholder;
    use LimitsFieldLength;

    /** @var array|null An array of user IDs that will be selected at initial load */
    protected ?array $initialUsers = null;

    /**
     * Create a new Menu element listing all workspace users visible to the current user
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#users_multi_select
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'multi_users_select';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function initialUsers(array $users): static
    {
        $this->initialUsers = array_filter(
            $users,
            fn ($v) => is_string($v)
        );

        return $this;
    }
}
