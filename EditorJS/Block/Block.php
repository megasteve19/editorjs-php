<?php

namespace Megasteve19\EditorJS\Block
{
    /**
     * Base class for all block types.
     * 
     * @author megasteve19
     * 
     * @property string $id
     * @property string $type
     * @property array $data
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
         * Get methods for the properties.
         * 
         * @param string $name The name of the property to get.
         * @return mixed The value of the property.
         */
        public function __get(string $name)
        {
            return $this->$name;
        }

        /**
         * Search for a specific key in the block's data.
         * Syntax: `$block->get('key1.key2.key3')`.
         * 
         * @param string $key The key to get the data from.
         * @return mixed|null The data or null if not found.
         */
        public function get(string $key)
        {
            $data = &$this->data;
            $keys = explode('.', $key);
            foreach($keys as $key)
            {
                if(empty($data[$key]))
                {
                    return null;
                }
                $data = &$data[$key];
            }
            return $data;
        }

        /**
         * Set a new value for a specific key in the block's data.
         * Syntax: `$block->set('key1.key2.key3', $value)`.
         * 
         * @param string $key The key to set the data.
         * @param mixed $value The value to set.
         * @return void
         */
        public function set(string $key, mixed $value)
        {
            $data = &$this->data;
            $keys = explode('.', $key);
            foreach($keys as $key)
            {
                if(empty($data[$key]))
                {
                    $data[$key] = [];
                }
                $data = &$data[$key];
            }
            $data = $value;
        }

        /**
         * Check if a specific key exists in the block's data.
         * Syntax: `$block->has('key1.key2.key3')`.
         * 
         * @param string $key The key to check.
         * @return bool True if the key exists, false otherwise.
         */
        public function has(string $key)
        {
            $data = &$this->data;
            $keys = explode('.', $key);
            foreach($keys as $key)
            {
                if(empty($data[$key]))
                {
                    return false;
                }
                $data = &$data[$key];
            }
            return true;
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
