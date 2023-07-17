<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class DispatchConfig extends ObjectBase implements SlackObjectContract
{
    /** @var bool If true, dispatch when enter is pressed */
    private bool $onEnterPressed = false;

    /** @var bool If true, dispatch when any character is entered */
    private bool $onCharacterEntered = false;

    /**
     * Construct a new Dispatch Action Configuration object
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#dispatch_action_config
     * @param array|null $triggerActionsOn An array of interaction types that you would like to receive a block_actions payload for
     */
    public function __construct(protected ?array $triggerActionsOn = null)
    {
        if (is_array($this->triggerActionsOn)) {
            $this->onEnterPressed = in_array('on_enter_pressed', $this->triggerActionsOn);
            $this->onCharacterEntered = in_array('on_character_entered', $this->triggerActionsOn);
        }
    }

    public function onEnterPressed(bool $enter = true): static
    {
        $this->onEnterPressed = $enter;

        return $this;
    }

    public function onCharacterEntered(bool $char = true): static
    {
        $this->onCharacterEntered = $char;

        return $this;
    }

    public function toArray(): array
    {
        if ($this->onEnterPressed && !in_array('on_enter_pressed', $this->triggerActionsOn)) {
            $this->triggerActionsOn[] = 'on_enter_pressed';
        }
        if ($this->onCharacterEntered && !in_array('on_character_entered', $this->triggerActionsOn)) {
            $this->triggerActionsOn[] = 'on_character_entered';
        }

        return parent::toArray();
    }
}
