<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;
use NathanHeffley\LaravelSlackBlocks\Objects\PlainText;

class Header extends BlockBase implements SlackBlockContract
{
    use LimitsFieldLength;

    /** @var PlainText The Text object for the block */
    protected PlainText $text;

    /**
     * Create a new Text block
     *
     * @see https://api.slack.com/reference/block-kit/blocks#text
     * @param string|PlainText $text The text for the block
     */
    public function __construct(string|PlainText $text)
    {
        $this->type = 'header';
        $this->text = is_string($text) ? new PlainText($text) : $text;
        $this->validateFieldLengths(["text" => 150]);
    }
}
