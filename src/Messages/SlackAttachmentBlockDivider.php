<?php

namespace NathanHeffley\LaravelSlackBlocks\Messages;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;

/**
 * @deprecated since version 3.0, no longer in use
 * @see \NathanHeffley\LaravelSlackBlocks\Blocks\Divider
 */
class SlackAttachmentBlockDivider implements SlackBlockContract
{
    /**
     * Get the array representation of the attachment block.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => 'divider',
        ];
    }
}
