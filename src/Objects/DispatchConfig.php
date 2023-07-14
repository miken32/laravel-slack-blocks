<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class DispatchConfig extends ObjectBase implements SlackObjectContract
{
    protected array $triggerActionsOn = [];

    /**
     * Construct a new Dispatch Action Configuration object
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#dispatch_action_config
     * @param bool $onEnterPressed If true, dispatch when enter is pressed
     * @param bool $onCharacterEntered If true, dispatch when any character is entered
     */
    public function __construct(bool $onEnterPressed, bool $onCharacterEntered = false)
    {
        if ($onEnterPressed) {
            $this->triggerActionsOn[] = 'on_enter_pressed';
        }
        if($onCharacterEntered) {
            $this->triggerActionsOn[] = 'on_character_entered';
        }
    }
}
