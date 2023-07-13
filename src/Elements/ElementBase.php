<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\ExposesFieldsAsArray;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;

abstract class ElementBase implements SlackBlockContract
{
    use ExposesFieldsAsArray;

    /** @var string The type field value */
    protected string $type;

    /** @var string The action_id field value */
    protected string $actionId;
}
