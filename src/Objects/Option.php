<?php

namespace NathanHeffley\LaravelSlackBlocks\Objects;

use NathanHeffley\LaravelSlackBlocks\Concerns\LimitsFieldLength;
use NathanHeffley\LaravelSlackBlocks\Contracts\SlackObjectContract;

class Option extends ObjectBase implements SlackObjectContract
{
    use LimitsFieldLength;

    /** @var PlainText The text shown in the option on the menu */
    protected TextBase $text;

    /** @var PlainText|null A line of descriptive text shown below the text field beside the radio button */
    protected ?PlainText $description = null;

    /** @var string|null In overflow menus, a URL to load in the user's browser when the option is clicked */
    protected ?string $url = null;

    /**
     * Construct a new Option object for menu, checkboxes, radios, etc
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#option
     * @param string|Markdown $text The content of the text Plain Text object, or a Markdown Text object for radio buttons and checkboxes
     * @param string $value A unique string value that will be passed to your app when this option is chosen
     */
    public function __construct(string|Markdown|PlainText $text, protected string $value)
    {
        $this->text = is_string($text) ? new PlainText($text) : $text;
        $this->validateFieldLengths([
            'text' => 75,
            'value' => 75,
        ]);
    }

    public function description(string|PlainText $text): static
    {
        $this->description = is_string($text) ? new PlainText($text) : $text;
        $this->validateFieldLengths(['description' => 75]);

        return $this;
    }

    public function url(string $url): static
    {
        $this->url = $url;
        $this->validateFieldLengths(['url' => 3000]);

        return $this;
    }
}
