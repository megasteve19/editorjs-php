<?php

namespace Megasteve19\EditorJS\Block;
{
    /**
     * Base class for all block types.
     * 
     * @author megasteve19
     */
    class Block
    {
        /**
         * @var string The block's unique ID.
         */
        private string $id;

        /**
         * @var string Type of the block.
         */
        private string $type;

        /**
         * @var array Data of the block.
         */
        private array $data;

        /**
         * Constructor
         * 
         * @param array $block The block data to fill the object with.
         * @return void
         */
        public function __construct(array $block)
        {
            $this->id = uniqid('editorjs');
            $this->type = $block['type'];
            $this->data = $block['data'] ?? [];
        }

        /**
         * Get the block's unique ID.
         * 
         * @return string
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Get the block's type.
         * 
         * @return string
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * Get the block's data.
         * 
         * @return array
         */
        public function getData()
        {
            return $this->data;
        }

        /**
         * Rescurively search for a specific key in the block's data.
         * Syntax: `$block->find('key1.key2.key3')`.
         * 
         * @param string $key The key to get the data from.
         * @return mixed|null The data or null if not found.
         */
        public function find(string $key)
        {
            $data = $this->data;
            $keys = explode('.', $key);
            foreach($keys as $key)
            {
                if(isset($data[$key]))
                    $data = $data[$key];
                else
                    return null;
            }
            return $data;
        }

        /**
         * Inserts a new data key into the block's data.
         * Syntax: `$block->insert('key1.key2.key3', $value)`.
         * 
         * @param string $key The key to insert.
         * @param mixed $value The value to insert.
         * @return bool True if the key was inserted, false otherwise.
         */
        public function insert(string $key, $value)
        {
            $keys = explode('.', $key);
            $data = &$this->data;
            
            foreach($keys as $key)
            {
                if(empty($data[$key]))
                    $data[$key] = [];
                $data = &$data[$key];
            }

            // Check if the key already exists.
            if(empty($data))
            {
                $data = $value;
                return true;
            }
            return false;
        }

        /**
         * Update the block's data with a new one.
         * Syntax: `$block->update('key1.key2.key3', $newData)`.
         * 
         * @param string $key The key to replace the data.
         * @param mixed $data The new data.
         * @return bool True if the key was updated, false otherwise.
         */
        public function update(string $key, $newData)
        {
            $data = &$this->data;
            $keys = explode('.', $key);
            foreach($keys as $key)
            {
                if(isset($data[$key]))
                    $data = &$data[$key];
                else
                    return false;
            }
            $data = $newData;
            return true;
        }

        /**
         * Remove a key from the block's data.
         * Syntax: `$block->remove('key1.key2.key3')`.
         * 
         * @param string $key The key to remove.
         * @return bool True if the key was removed, false otherwise.
         */
        public function delete(string $key)
        {
            $keys = explode('.', $key);
            $lastKey = array_pop($keys);
            $data = &$this->data;

            foreach($keys as $key)
            {
                if(empty($data[$key]))
                {
                    return;
                }
                $data = &$data[$key];
            }

            // Unset if the key exists.
            if(!empty($data[$lastKey]))
            {
                unset($data[$lastKey]);
                return true;
            }
            return false;
        }

        /**
         * Convert the block to an array.
         * 
         * @return array Converted block.
         */
        public function toArray()
        {
            return [ 'type' => $this->type, 'data' => $this->data ];
        }

        /**
         * Renders HTML from the block.
         * 
         * @param string $templatePath The path to the template file.
         * @return string If template exists returns the rendered HTML, otherwise returns an empty string.
         */
        public function toHTML(string $templatePath)
        {
            if(file_exists($templatePath))
            {
                ob_start();
                extract($this->data, EXTR_SKIP);
                include $templatePath;
                return ob_get_clean();
            }
            return '';
        }
    }
}
