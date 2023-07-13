<?php

namespace NathanHeffley\LaravelSlackBlocks\Messages;

use NathanHeffley\LaravelSlackBlocks\Contracts\SlackBlockContract;

class SlackBlock implements SlackBlockContract
{
    /**
     * The type field of the block.
     *
     * @var string
     */
    public string $type;

    /**
     * The text field of the block.
     *
     * @var array
     */
    public array $text;

    /**
     * The block ID field of the block.
     *
     * @var string
     */
    public string $id;

    /**
     * The fields field of the block.
     *
     * @var array
     */
    public array $fields;

    /**
     * The accessory field of the block.
     *
     * @var array
     */
    public array $accessory;

    /**
     * The url field of the block.
     *
     * @var string
     */
    public string $url;

    /**
     * The image url field of the block.
     *
     * @var string
     */
    public string $imageUrl;

    /**
     * The alt text field of the block.
     *
     * @var string
     */
    public string $altText;

    /**
     * The title field of the block.
     *
     * @var array
     */
    public array $title;

    /**
     * The elements field of the block.
     *
     * @var array
     */
    public array $elements;

    /**
     * Set the type of the block.
     *
     * @param string $type
     * @return $this
     */
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the text of the block.
     *
     * @param array $text
     * @return $this
     */
    public function text(array $text): static
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set the ID of the block.
     *
     * @param string $id
     * @return $this
     */
    public function id(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the fields of the block.
     *
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Set the accessory of the block.
     *
     * @param array $accessory
     * @return $this
     */
    public function accessory(array $accessory): static
    {
        $this->accessory = $accessory;

        return $this;
    }

    /**
     * Set the url of the block.
     *
     * @param string $url
     * @return $this
     */
    public function url(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the image url of the block.
     *
     * @param string $imageUrl
     * @return $this
     */
    public function imageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Set the alt text of the block.
     *
     * @param string $altText
     * @return $this
     */
    public function altText(string $altText): static
    {
        $this->altText = $altText;

        return $this;
    }

    /**
     * Set the title of the block.
     *
     * @param array $title
     * @return $this
     */
    public function title(array $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the elements of the block.
     *
     * @param array $elements
     * @return $this
     */
    public function elements(array $elements): static
    {
        $this->elements = $elements;

        return $this;
    }

    /**
     * Get the array representation of the block.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'text' => $this->text,
            'block_id' => $this->id,
            'fields' => $this->fields,
            'accessory' => $this->accessory,
            'image_url' => $this->imageUrl,
            'alt_text' => $this->altText,
            'title' => $this->title,
            'elements' => $this->elements,
        ]);
    }
}
