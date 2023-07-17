<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class Trigger extends ObjectBase implements SlackObjectContract
{
    /** @var array<InputParameter>|null An array of input parameter objects. Each specified name must match an input parameter defined on the workflow of the provided trigger */
    protected ?array $customizableInputParameters = null;

    /**
     * Construct a new Trigger object
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#trigger
     * @param string $url A link trigger URL
     */
    public function __construct(protected string $url)
    {
    }

    public function customizableInputParameters(array $params): static
    {
        $this->customizableInputParameters = array_filter(
            $params,
            fn ($v) => $v instanceof InputParameter
        );

        return $this;
    }
}
