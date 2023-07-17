<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use NathanHeffley\LaravelSlackBlocks\Concerns\ExposesFieldsAsArray;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;

abstract class BlockBase implements SlackBlockContract
{
    use ExposesFieldsAsArray;

    /** @var string|null The block_id field */
    protected ?string $blockId = null;

    /** @var string The type field */
    protected string $type;

    public function blockId(string $id): static
    {
        $this->blockId = $id;

        return $this;
    }
}
