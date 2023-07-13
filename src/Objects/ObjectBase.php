<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Concerns\ExposesFieldsAsArray;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

abstract class ObjectBase implements SlackObjectContract
{
    use ExposesFieldsAsArray;
}
