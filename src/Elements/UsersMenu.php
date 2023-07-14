<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\CanFocusOnLoad;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasConfirmationDialog;
use NathanHeffley\LaravelSlackBlocks\Concerns\HasPlaceholder;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class UsersMenu extends InteractiveElementBase implements SlackElementContract
{
    use CanFocusOnLoad;
    use HasConfirmationDialog;
    use HasPlaceholder;
    use LimitsFieldLength;


    /** @var string|null A user ID that will be selected at initial load */
    protected ?string $initialUser = null;

    /**
     * Create a new Menu element listing all workspace users visible to the current user
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#users_select
     * @param string $actionId An identifier for the action triggered when the checkbox group is changed
     */
    public function __construct(protected string $actionId)
    {
        $this->type = 'users_select';
        $this->validateFieldLengths(['action_id' => 255]);
    }

    public function initialUser(string $user): static
    {
        $this->initialUser = $user;

        return $this;
    }
}
