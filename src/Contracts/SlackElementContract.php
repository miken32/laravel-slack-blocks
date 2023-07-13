<?php

namespace NathanHeffley\LaravelSlackBlocks\Contracts;

interface SlackElementContract
{
    /**
     * Get the array representation of the block.
     *
     * @return array
     */
    public function toArray(): array;
}
