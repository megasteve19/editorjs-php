<?php

$block = new \Megasteve19\EditorJS\Block\Block([
    'type' => 'header',
    'data' => [
        'text' => 'Hello World!',
        'deep' => [
            'key' => 'value'
        ]
    ]
]);

print var_dump($block->get('deep.key')) . PHP_EOL;
print var_dump($block->id) . PHP_EOL;
