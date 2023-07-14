<?php

namespace NathanHeffley\LaravelSlackBlocks\Elements;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackElementContract;

class Image extends NonInteractiveElementBase implements SlackElementContract
{
    use LimitsFieldLength;

    /**
     * Create a new Image element
     *
     * @see https://api.slack.com/reference/block-kit/block-elements#image
     * @param string $imageUrl The URL of the image to be displayed
     * @param string $altText A  plain-text summary of the image. This should not contain any markup
     */
    public function __construct(protected string $imageUrl, protected string $altText)
    {
        $this->type = 'image';
        // no action_id on this element type, it's not interactive
        $this->actionId = null;
        $this->validateFieldLengths([
            'image_url' => 3000,
            'alt_text' => 2000,
        ]);
    }
}
