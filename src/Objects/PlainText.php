<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class PlainText extends TextBase implements SlackObjectContract
{
    protected string $type = 'plain_text';

    /**
     * Construct a new plain text-only Text object
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#text
     * @param string $text The text content
     * @param bool $emoji If true, convert emoji to Slack's colon format
     */
    public function __construct(string $text, bool $emoji = false)
    {
        parent::__construct($text, $emoji);
    }
}
