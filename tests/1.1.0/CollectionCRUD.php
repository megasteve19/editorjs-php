<?php
// Don't confuse, we have same test in 1.0.0 but not with arrays. It's just to test the new collection CRUD with arrays.

use \Megasteve19\EditorJS;

$editorJS = new EditorJS\EditorJS($sampleData, $config);

$collection = $editorJS->collection;

// Sample blocks.
$blocks = [];
$blocks[] = new EditorJS\Block\Block([
    'type' => 'paragraph',
    'data' => [
        'text' => 'This is a paragraph'
    ]
]);

$blocks[] = new EditorJS\Block\Block([
    'type' => 'list',
    'data' => [
        'style' => 'ordered',
        'items' => [
            'First item',
            'Second item',
            'Third item'
        ]
    ]
]);

$blocks[] = new EditorJS\Block\Block([
    'type' => 'image',
    'data' => [
        'file' => [ 'url' => 'https://via.placeholder.com/600/92c952' ]
    ]
]);

// Let try to insert them. Worked very well
$collection->insert($blocks);

// How about update? And yeah this worked well too.
$blocks[0]->update('text', 'This is a new text');
$blocks[1]->update('items', [
    'First item',
    'Second item',
    'Third item',
    'Fourth item'
]);
$blocks[2]->update('file', [ 'url' => 'https://example.com/image.jpeg' ]);

$collection->update($blocks);

// Sorry guys for deleting. Noice!
$collection->delete($blocks);

// And now we have to get all blocks. Nice as well.
$blocks = $collection->all('paragraph');
# print_r($blocks);

print_r($collection->toArray());
