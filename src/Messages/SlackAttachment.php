<?php

namespace NathanHeffley\LaravelSlackBlocks\Messages;

use Closure;
use Illuminate\Notifications\Messages\SlackAttachment as LaravelSlackAttachment;

class SlackAttachment extends LaravelSlackAttachment
{
    /**
     * The attachment's blocks.
     *
     * @var array
     */
    public array $blocks;

    /**
     * Add a block to the attachment.
     *
     * @param  \Closure  $callback
     * @return $this
     */
    public function block(Closure $callback): static
    {
        $this->blocks[] = $block = new SlackBlock();

        $callback($block);

        return $this;
    }

    /**
     * Add a divider block to the attachment.
     *
     * @return $this
     */
    public function dividerBlock(): static
    {
        $this->blocks[] = new SlackAttachmentBlockDivider();

        return $this;
    }

    /**
     * Add an image block to the attachment.
     *
     * @param string $imageUrl
     * @param string $altText
     * @param string|null $title
     * @return $this
     */
    public function imageBlock(string $imageUrl, string $altText, string $title = null): static
    {
        $this->blocks[] = new SlackAttachmentBlockImage($imageUrl, $altText, $title);

        return $this;
    }
}
