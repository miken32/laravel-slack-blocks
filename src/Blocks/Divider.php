<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;

class Divider extends BlockBase implements SlackBlockContract
{
    /**
     * Create a new Divider block
     *
     * @see https://api.slack.com/reference/block-kit/blocks#divider
     */
    public function __construct()
    {
        $this->type = 'divider';
    }
}
