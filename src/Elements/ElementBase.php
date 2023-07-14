<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\ExposesFieldsAsArray;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;

abstract class ElementBase implements SlackBlockContract
{
    use ExposesFieldsAsArray;

    /** @var string The type field value */
    protected string $type;

    /** @var string An identifier for the action triggered when a menu option is selected. You can use this when you receive an interaction payload to identify the source of the action. */
    protected string $actionId;
}
