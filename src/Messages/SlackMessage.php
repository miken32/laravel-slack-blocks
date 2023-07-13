<?php

namespace NathanHeffley\LaravelSlackBlocks\Messages;

use Closure;
use Illuminate\Notifications\Messages\SlackMessage as LaravelSlackMessage;
use NathanHeffley\LaravelSlackBlocks\Messages\SlackBlock;

class SlackMessage extends LaravelSlackMessage
{
    /**
     * The message's blocks.
     *
     * @var array
     */
    public array $blocks;

    /**
     * Define an attachment for the message.
     *
     * @param  \Closure  $callback
     * @return $this
     */
    public function attachment(Closure $callback): static
    {
        $this->attachments[] = $attachment = new SlackAttachment();

        $callback($attachment);

        return $this;
    }

    /**
     * Add a block to the message.
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
}
