Please refer to new [package](https://github.com/bumpcore/editor.php).

# EditorJS Extended
Hi, I was just building a back-end project, and a little EditorJS parser. It's ended up with a useful little library. It's my first package, so please be kind and give me feedback.
***

# Installation
To install package via composer run:
```
composer require megasteve1987/editorjs
```

>**Note:** You should look the original package's `README.md` on [GitHub](https://github.com/editor-js/editorjs-php)

# Basic usage
First of all use the `EditorJS` class:

```php
use Megasteve19\EditorJS\EditorJS;
```
    
Then you can create a new instance of the class:

```php
$editorJS = new EditorJS( $json, $config );
```

As you can see It's constructor same as original EditorJS.

- `$json` - JSON string from frontend.
- `$config` - JSON string that contains configuration.

# Collection CRUD
This package resolves around CRUD operations. Here's a example;

```php
$editorJS = new EditorJS($json, $config);

// Create a new block
$newBlockData = new \Megasteve19\EditorJS\Blocks\Block([
    'type' => 'header',
    'data' => [
        'text' => 'Hello World',
        'level' => 1
    ]
]);

// Push the new block to the collection
$editorJS->collection->insert($newBlock);

```

Or find a block by id and access some data of it:

```php
echo $editorJS->collection->find($id)->find('text');
```

Here's all functions that collection has:

- `all($type)` - Returns all blocks. You can give type of blocks you want to get but it's optional. 
- `find($id)` - Returns block by id.
- `insert($block)` - Inserts a block to the collection. You can pass a block or an array of blocks.
- `update($block)` - Updates a block in the collection. You can pass a block or an array of blocks.
- `delete($block)` - Deletes a block from the collection. You can pass a block or an array of blocks.
- `count()` - Returns count of blocks.
- `clear()` - Clears the collection.
- `toArray()` - Returns collection as array.
- `toHTML($templatesPath)` - Returns collection as HTML.

>You can find more about html templates at end of this file.

# Block CRUD
If we have data to store, than we should use some crud methods right? Blocks crud almost same as collection's. Here's a example:

```php
// Find a block
$block = $editorJS->collection->find($id);

// Update block
$block->insert('alt', 'alt text');
$block->update('file.url', 'http://example.com/image.jpg');

// Update collection
$editorJS->collection->update($block);
```

As you can see we're accesing data by dot notation. So I hope you get the point. Here's list of all methods that blocks has:

- `getId()` - Returns block id.
- `getType()` - Returns block type.
- `getData()` - Returns block data.
- `find($key)` - Returns specific data by key.
- `insert($key, $value)` - Inserts data to the block.
- `update($key, $value)` - Updates data in the block.
- `delete($key)` - Deletes data from the block.
- `toArray()` - Returns block as array.
- `toHTML($templatePath)` - Returns block as HTML.

# EdiorJS Class
This class is a wrapper for collection. It's a singleton with a few methods. Here's list of all methods;

- `toJSON()` - Returns colection as JSON string. It's important to use this method to use data in also frontend.
- `toHTML($templatesPath)` - Renders collection as HTML.

# About Templates
This package uses templates to render blocks. Collection needs a directory with templates. Structure of this directory is below;

```
editorjs-templates/
├─ image.php
├─ header.php
├─ paragraph.php
```

You can name directory whatever you want, but it's important to name files by block type. So, if you want to use `header` template, you should name it `header.php`.

Templates uses PHP's default syantax and rendering happens inside block's `toHTML()` method. That means you can access all block's methods and data. Here's an example of `image` template;

```php

<img src=" <?= $this->find('file.url') ?> " alt=" $this->find('alt') ?? '' ">

```

***
Thanks for reading to the end. If you have any questions, please don't hesitate to contact me.
