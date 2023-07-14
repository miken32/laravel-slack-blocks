<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

abstract class NonInteractiveElementBase extends ElementBase
{
    /** @var bool Whether this is an interactive form element */
    private bool $interactive = false;
}
