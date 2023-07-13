<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class Markdown extends TextBase implements SlackObjectContract
{
    protected string $type = 'mrkdwn';

    /**
     * Construct a new Text object with Markdown rendering
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#text
     * @param string $text The text content
     * @param bool $verbatim If true, prevent auto-linking of URLs, channels, etc
     */
    public function __construct(string $text, bool $verbatim = false)
    {
        parent::__construct($text, verbatim: $verbatim);
    }
}
