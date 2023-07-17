<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class Markdown extends TextBase implements SlackObjectContract
{
    protected string $type = 'mrkdwn';

    /** @var bool If true, prevent auto-linking of URLs, channels, etc */
    protected bool $verbatim = false;

    public function verbatim(bool $verbatim = true): static
    {
        $this->verbatim = $verbatim;

        return $this;
    }
}
