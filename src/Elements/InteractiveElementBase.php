<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

abstract class InteractiveElementBase extends ElementBase
{
    /** @var bool Whether this is an interactive form element */
    private bool $interactive = true;
}
