<?php

$block = new \Megasteve19\EditorJS\Block\Block([
    'type' => 'image',
    'data' => [
        'file' => [ 'url' => 'https://example.com/image.jpg' ],
    ]
]);

// These are successful.
$block->insert('caption.alt', 'This is a alt.');
$block->insert('foo.bar.baz', 'This is a baz.');

// Updating on insert bug. FIXED.
$block->insert('caption.title', 'This is a title.');
$block->insert('caption.title', 'Updating already inserted data? Nope I Can not allow it.');

// Nice, like It's big brother, It's not making the same mistake. Just doing It job.
$block->update('file.url', 'https://example.com/image.jpg');
$block->update('file.url.some', 'https://example.com/image.jpg');

// Failed.. Nope It's successful now.
$block->delete('caption.title');
$block->delete('foo.bar.baz');

print_r($block->toArray());
