<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

class InputParameter extends ObjectBase implements \NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract
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
