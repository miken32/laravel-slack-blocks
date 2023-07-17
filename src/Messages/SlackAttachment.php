<?php

namespace NathanHeffley\LaravelSlackBlocks\Messages;

use Closure;
use Illuminate\Notifications\Messages\SlackAttachment as LaravelSlackAttachment;
use NathanHeffley\LaravelSlackBlocks\Blocks\Divider;
use NathanHeffley\LaravelSlackBlocks\Blocks\Header;
use NathanHeffley\LaravelSlackBlocks\Blocks\Image;

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
        $this->blocks[] = new Divider();

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
        $image = new Image($imageUrl, $altText);
        if ($title) {
            $image->title($title);
        }
        $this->blocks[] = $image;

        return $this;
    }

    /**
     * Add a header block to the attachment
     *
     * @param string $text
     * @return $this
     */
    public function headerBlock(string $text): static
    {
        $this->blocks[] = new Header($text);

        return $this;
    }
}
