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
    protected ?PlainText $description;

    /**
     * Construct a new Option object for menu, checkboxes, radios, etc
     *
     * @see https://api.slack.com/reference/block-kit/composition-objects#option
     * @param string|Markdown $text The content of the text Plain Text object, or a Markdown Text object for radio buttons and checkboxes
     * @param string $value A unique string value that will be passed to your app when this option is chosen
     * @param string $description The content of the description Text object
     * @param string $url In overflow menus, a URL to load in the user's browser when the option is clicked
     */
    public function __construct(string|Markdown $text, protected string $value, string $description = '', protected string $url = '')
    {
        $this->text = is_string($text) ? new PlainText($text) : $text;
        $this->description = $description ? new PlainText($description) : null;
        $this->validateFieldLengths([
            'text' => 75,
            'description' => 75,
            'url' => 3000,
        ]);
    }
}
