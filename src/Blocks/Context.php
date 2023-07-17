<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;
use NathanHeffley\LaravelSlackBlocks\Elements\Image;
use NathanHeffley\LaravelSlackBlocks\Objects\TextBase;

class Context extends BlockBase implements SlackBlockContract
{
    use LimitsFieldLength;

    /**
     * Construct a Context block
     *
     * @see https://api.slack.com/reference/block-kit/blocks#context
     * @param array<Image|TextBase> $elements An array of image elements and text objects
     */
    public function __construct(protected array $elements)
    {
        $this->type = 'context';
        $this->validateFieldLengths(["elements" => 10]);
        $this->elements = array_filter(
            $this->elements,
            fn ($v) => $v instanceof Image || $v instanceof TextBase
        );
    }
}
