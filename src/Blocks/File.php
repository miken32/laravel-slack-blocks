<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;

class File extends BlockBase implements SlackBlockContract
{
    /** @var string At the moment, source will always be remote for a remote file */
    protected string $source = 'remote';

    /**
     * Create a new File block
     *
     * @see https://api.slack.com/reference/block-kit/blocks#file
     * @param string $sourceId The external unique ID for this file
     */
    public function __construct(protected string $sourceId)
    {
        $this->type = 'file';
    }
}
