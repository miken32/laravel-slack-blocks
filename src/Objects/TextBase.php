<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

abstract class TextBase extends ObjectBase implements SlackObjectContract
{
    /** @var string The type field */
    protected string $type;

    /**
     * Base text object creation
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#text
     * @param string $text The text content
     * @param bool $emoji If using plain text, whether to convert emoji to Slack's colon format
     * @param bool $verbatim If using Markdown, whether to prevent auto-linking of URLs, channels, etc
     */
    public function __construct(protected string $text, protected bool $emoji = false, protected bool $verbatim = false)
    {
    }

    public function trim(int $length): void
    {
        $this->text = substr($this->text, 0, $length);
    }

    public function __toString(): string
    {
        return $this->text;
    }
}
