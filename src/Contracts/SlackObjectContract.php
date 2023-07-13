<?php

namespace NathanHeffley\LaravelSlackBlocks\Contracts;

interface SlackObjectContract
{
    /**
     * Get the array representation of the object.
     *
     * @return array<string,string|array>
     */
    public function toArray(): array;
}
