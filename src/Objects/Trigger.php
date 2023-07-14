<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class Trigger extends ObjectBase implements SlackObjectContract
{
    /**
     * Construct a new Trigger object
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#trigger
     * @param string $url A link trigger URL
     * @param array<InputParameter> $customizableInputParameters An array of input parameter objects. Each specified name must match an input parameter defined on the workflow of the provided trigger
     */
    public function __construct(protected string $url, protected array $customizableInputParameters = [])
    {
        $this->customizableInputParameters = array_filter(
            $this->customizableInputParameters,
            fn ($v) => $v instanceof InputParameter
        );
    }
}
