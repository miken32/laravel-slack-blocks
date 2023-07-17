<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;
use NathanHeffley\LaravelSlackBlocks\Elements\InteractiveElementBase;

class Actions extends BlockBase implements SlackBlockContract
{
    use LimitsFieldLength;

    /**
     * Construct an Actions block
     *
     * @see https://api.slack.com/reference/block-kit/blocks#actions
     * @param array<InteractiveElementBase> $elements An array of interactive elements
     */
    public function __construct(protected array $elements)
    {
        $this->type = 'actions';
        $this->validateFieldLengths(["elements" => 25]);
        $this->elements = array_filter(
            $this->elements,
            fn ($v) => $v instanceof InteractiveElementBase
        );
    }
}
