<?php

$editorJS = new \Megasteve19\EditorJS\EditorJS($sampleData, $config);

$block = new \Megasteve19\EditorJS\Block\Block([
    'type' => 'header',
    'data' => [
        'text' => "Please, don't kill me master!",
        'level' => 2
    ]
]);

$collection = $editorJS->collection;

// Insert
$collection->insert($block);

// Get
$finded = $collection->find($block->getId());
//print_r($finded->toArray());

$filteredByType = $collection->getBlocksByType('header');
//print_r($filteredByType);

$allBlocks = $collection->all();
//print_r($allBlocks);

// Update
$finded->update('text', 'Wow, you are just updating me master!');
$collection->update($finded);

// Delete, It's end of the road buddy...
$collection->delete($finded);

print_r($collection->toArray());
