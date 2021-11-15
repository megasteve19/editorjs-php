<?php

namespace Megasteve19\EditorJS
{
    /**
     * Handles the EditorJS content.
     * 
     * @author megasteve19
     */
    class EditorJS
    {
        /**
         * Block collection.
         */
        public Block\Collection $collection;

        /**
         * Constructor.
         * 
         * @param string $json JSON to parse.
         * @return void
         */
        public function __construct(string $json, string $config)
        {
            $editorJS = new \EditorJS\EditorJS($json, $config);
            $this->collection = new Block\Collection($editorJS->getBlocks());
        }

        /**
         * Encodes the block collection to JSON.
         * 
         * @return string JSON data.
         */
        public function toJSON()
        {
            return json_encode([ 'blocks' => $this->collection->toArray() ]);
        }

        /**
         * Renders HTML from the block collection.
         * 
         * @param string $templatesPath Template path to use.
         * @return string HTML.
         */
        public function toHTML(string $templatesPath)
        {
            return $this->collection->toHTML($templatesPath);
        }
    }
}
