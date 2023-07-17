<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;
use NathanHeffley\LaravelSlackBlocks\Objects\PlainText;

class Image extends BlockBase implements SlackBlockContract
{
    use LimitsFieldLength;

    /** @var PlainText The block's title field. */
    protected PlainText $title;

    /**
     * Create a new Image block
     *
     * @see https://api.slack.com/reference/block-kit/blocks#image
     * @param string $imageUrl The image's URL.
     * @param string $altText The image's alt text.
     */
    public function __construct(protected string $imageUrl, protected string $altText)
    {
        $this->type = 'image';
        $this->validateFieldLengths([
            'image_url' => 3000,
            'alt_text' => 2000,
        ]);
    }

    /**
     * Set the title field
     *
     * @param string|PlainText $title The image's title (shown on hover)
     * @return $this
     */
    public function title(string|PlainText $title): static
    {
        $this->title = is_string($title) ? new PlainText($title) : $title;
        $this->validateFieldLengths(['title' => 2000]);

        return $this;
    }
}
