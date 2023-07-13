<?php

namespace NathanHeffley\LaravelSlackBlocks\Messages;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;

class SlackAttachmentBlockImage implements SlackBlockContract
{

    /**
     * Create a new block image.
     *
     * @param string $imageUrl The image's URL.
     * @param string $altText The image's alt text.
     * @param string|null $title The image's title.
     */
    public function __construct(protected string $imageUrl, protected string $altText, protected ?string $title = null)
    {
    }

    /**
     * Get the array representation of the attachment block.
     *
     * @return array
     */
    public function toArray(): array
    {
        $titleData = $this->title ? [
            'type' => 'plain_text',
            'text' => $this->title,
        ] : null;

        return array_filter([
            'type' => 'image',
            'title' => $titleData,
            'image_url' => $this->imageUrl,
            'alt_text' => $this->altText,
        ]);
    }
}
