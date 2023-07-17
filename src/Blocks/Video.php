<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;
use NathanHeffley\LaravelSlackBlocks\Objects\PlainText;
use ValueError;

class Video extends BlockBase implements SlackBlockContract
{
    use LimitsFieldLength;

    /** @var PlainText The video's title */
    protected PlainText $title;

    /** @var PlainText|null The video's description */
    protected ?PlainText $description;

    /** @var string|null Author name to be displayed */
    protected ?string $authorName = null;

    /** @var string|null The originating application or domain of the video e.g. YouTube */
    protected ?string $providerName = null;

    /** @var string|null Icon for the video provider e.g. YouTube icon (https only) */
    protected ?string $providerIconUrl = null;

    /** @var string|null Hyperlink for the title text. Must correspond to the non-embeddable URL for the video (https only) */
    protected ?string $titleUrl = null;

    /**
     * Create a new Video block
     *
     * @see https://api.slack.com/reference/block-kit/blocks#video
     * @param string $videoUrl The video's URL (https only)
     * @param string $thumbnailUrl The thumbnail image's URL (https only)
     * @param string $altText The video's alt text
     * @param string $title The content of the text field
     */
    public function __construct(
        protected string $videoUrl,
        protected string $thumbnailUrl,
        protected string $altText,
        string $title
    )
    {
        $this->type = 'video';
        $this->title = new PlainText($title);
        if (!str_starts_with($videoUrl, 'https://') || !str_starts_with($thumbnailUrl, 'https://')) {
            throw new ValueError('All URLs must use the https scheme');
        }
        $this->validateFieldLengths([
            'video_url' => 3000,
            'thumbnail_url' => 3000,
            'alt_text' => 2000,
            'title' => 200,
        ]);
    }

    /**
     * Set the description field
     *
     * @param string|PlainText $text The video's description
     * @return $this
     */
    public function description(string|PlainText $text): static
    {
        $this->description = is_string($text) ? new PlainText($text) : $text;
        $this->validateFieldLengths(['title' => 2000]);

        return $this;
    }

    public function authorName(string $name): static
    {
        $this->authorName = $name;
        $this->validateFieldLengths(['author_name' => 50]);

        return $this;
    }

    public function providerName(string $name): static
    {
        $this->providerName = $name;
        $this->validateFieldLengths(['provider_name' => 50]);

        return $this;
    }

    public function providerIconUrl(string $url): static
    {
        if (!str_starts_with($url, 'https://')) {
            throw new ValueError('All URLs must use the https scheme');
        }
        $this->providerIconUrl = $url;
        $this->validateFieldLengths(['provider_icon_url' => 3000]);

        return $this;
    }

    public function titleUrl(string $url): static
    {
        if (!str_starts_with($url, 'https://')) {
            throw new ValueError('All URLs must use the https scheme');
        }
        $this->titleUrl = $url;
        $this->validateFieldLengths(['title_url' => 3000]);

        return $this;
    }
}
