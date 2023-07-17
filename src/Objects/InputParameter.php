<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class InputParameter extends ObjectBase implements SlackObjectContract
{
    /**
     * Construct a new Input Parameter object
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#input_parameter
     * @param string $name The name of the input parameter
     * @param string $value The value of the input parameter
     */
    public function __construct(protected string $name, protected string $value)
    {
    }
}
