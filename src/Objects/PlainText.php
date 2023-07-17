<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class PlainText extends TextBase implements SlackObjectContract
{
    protected string $type = 'plain_text';

    /** @var bool If true, convert emoji to Slack's colon format */
    protected ?bool $emoji = null;

    public function emoji(bool $emoji = true): static
    {
        $this->emoji = $emoji;

        return $this;
    }
}
