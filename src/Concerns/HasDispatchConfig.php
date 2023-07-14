<?php

namespace NathanHeffley\LaravelSlackBlocks\Concerns;

use NathanHeffley\LaravelSlackBlocks\Objects\DispatchConfig;

trait HasDispatchConfig
{
    /** @var DispatchConfig|null Configures when during text input the element returns a payload */
    protected ?DispatchConfig $dispatchActionConfig = null;


}
