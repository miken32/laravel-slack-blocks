# Laravel Slack Blocks

This package is an extension of the official `laravel/slack-notification-channel` package.

> **Note**
> Thes core notifications package has finally built-in support for these rich Slack messages, and as such you should use the official package if you are able.
>
> https://laravel.com/docs/10.x/notifications#formatting-slack-notifications

## Usage

Instead of requiring the official package, you should require this one instead.

```
composer require nathanheffley/laravel-slack-blocks
```

Because this package is built on top of the official one, you'll have all the functionality found in the [official docs](https://laravel.com/docs/5.8/notifications#slack-notifications).

You can follow those instructions with the slight adjustment of requiring the classes from `NathanHeffley\LaravelSlackBlocks` instead of `Illuminate\Notifications`.

Everything supported in the base Illuminate Notifications classes is supported in these extended classes.

If you want to add a block to your Slack message, you need to add the block in an attachment. This can be done with the `SlackAttachment::block()` method:

```php
use NathanHeffley\LaravelSlackBlocks\Messages\SlackMessage;

// ...

public function toSlack($notifiable)
{
    return (new SlackMessage)
        ->attachment(function ($attachment) {
            $attachment->block(function ($block) {
                $block
                    ->type('section')
                    ->text([
                        'type' => 'mrkdwn',
                        'text' => '*Hello World!*',
                    ]);
            });
        });
}
```
To help, some blocks have been given dedicated helper functions on the attachment model itself. Currently there are methods for adding headers, images, and dividers.

```php
(new SlackMessage)->attachment(function ($attachment) {
    $attachment->headerBlock('Some Important Text');
    $attachment->imageBlock('http://placekitten.com/300/200', 'A cute kitten');
    $attachment->dividerBlock();
    $attachment->imageBlock('http://placekitten.com/300/200', 'A cute kitten', 'This is a titled cat image');
});
```

For more complicated messages, it will be easier to access the `SlackMessage::$blocks` array directly, and use the provided classes to create the blocks and their child elements and objects:

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NathanHeffley\LaravelSlackBlocks\Blocks;
use NathanHeffley\LaravelSlackBlocks\Channels\SlackWebhookChannel;
use NathanHeffley\LaravelSlackBlocks\Elements;
use NathanHeffley\LaravelSlackBlocks\Messages\SlackMessage;
use NathanHeffley\LaravelSlackBlocks\Objects;

class MySlackNotification extends Notification
{    
    public function via($notifiable):
    {
        return [SlackWebhookChannel::class];
    }

    public function toSlack($notifiable)
    {
        $message = new SlackMessage();
        $message->blocks = [
            new Blocks\Header('Important Survey'),
            new Blocks\Image('http://placekitten.com/300/200', 'A cute kitten'),
            new Blocks\Input(
                'Do you like this cat?',
                new Elements\RadioGroup('cat_like', [
                    new Objects\Option('Yes', '1'),
                    new Objects\Option('No', '0'),
                ]);
            ),
            new Blocks\Divider(),
            (new Blocks\Actions([
                new Elements\Button('new_cat', 'Request new cat'),
            ]))->blockId('button_block'),
        ];
    
        return $message;
    }
}
```
The provided code results in [this message](https://app.slack.com/block-kit-builder/T1XS5UJQM#%7B%22blocks%22:%5B%7B%22type%22:%22header%22,%22text%22:%7B%22type%22:%22plain_text%22,%22text%22:%22Important%20Survey%22%7D%7D,%7B%22type%22:%22image%22,%22image_url%22:%22http://placekitten.com/300/200%22,%22alt_text%22:%22A%20cute%20kitten%22%7D,%7B%22type%22:%22input%22,%22element%22:%7B%22type%22:%22radio_buttons%22,%22options%22:%5B%7B%22text%22:%7B%22type%22:%22plain_text%22,%22text%22:%22Yes%22%7D,%22value%22:%221%22%7D,%7B%22text%22:%7B%22type%22:%22plain_text%22,%22text%22:%22No%22%7D,%22value%22:%220%22%7D%5D,%22action_id%22:%22cat_like%22%7D,%22label%22:%7B%22type%22:%22plain_text%22,%22text%22:%22Do%20you%20like%20this%20cat?%22%7D%7D,%7B%22type%22:%22divider%22%7D,%7B%22type%22:%22actions%22,%22block_id%22:%22button_block%22,%22elements%22:%5B%7B%22type%22:%22button%22,%22text%22:%7B%22type%22:%22plain_text%22,%22text%22:%22Request%20new%20cat%22%7D,%22action_id%22:%22new_cat%22%7D%5D%7D%5D%7D)

To see all the possible fields you can add to a block, check out the [official Slack Blocks documentation](https://api.slack.com/reference/messaging/blocks).
