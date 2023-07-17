<?php

namespace NathanHeffley\LaravelSlackBlocks\Blocks;

use InvalidArgumentException;
use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;
use NathanHeffley\LaravelSlackBlocks\Elements;
use NathanHeffley\LaravelSlackBlocks\Elements\ElementBase;
use NathanHeffley\LaravelSlackBlocks\Objects\PlainText;
use NathanHeffley\LaravelSlackBlocks\Objects\TextBase;
use ValueError;

class Section extends BlockBase implements SlackBlockContract
{
    use LimitsFieldLength;

    /** @var PlainText|null The Text object for the block */
    protected ?PlainText $text = null;

    /** @var ElementBase An accessory object for the block */
    protected ElementBase $accessory;

    /**
     * Create new Section block
     * @param string|TextBase|null $text Text content of the block. Always recommended, but not required if $fields is specified
     * @param array<TextBase>|null $fields An array of Text objects rendered in a compact two-column format
     */
    public function __construct(string|TextBase|null $text = null, protected ?array $fields = null)
    {
        if (is_null($text) && is_null($this->fields)) {
            throw new InvalidArgumentException('At least one of $text or $fields must be specified');
        }
        if (!is_null($text)) {
            $this->text = is_string($text) ? new PlainText($text) : $text;
        }
        if (is_array($fields)) {
            $this->fields = array_filter(
                $this->fields,
                fn ($v) => $v instanceof TextBase
            );
        }
    }

    public function accessory(ElementBase $element): static
    {
        $bad_classes = [
            Elements\DatePicker::class,
            Elements\Email::class,
            Elements\Number::class,
            Elements\Text::class,
            Elements\Url::class,
        ];
        if (in_array(get_class($element), $bad_classes)) {
            throw new ValueError('The accessory element must be compatible with a section block');
        }
        $this->accessory = $element;

        return $this;
    }
}
