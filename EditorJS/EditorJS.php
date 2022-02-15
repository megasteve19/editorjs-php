<?php

namespace Megasteve19\EditorJS
{
    use Megasteve19\EditorJS\Block\{ Block, Collection };

    /**
     * Handles the EditorJS content.
     * 
     * @author megasteve19
     */
    class EditorJS
    {
        /**
         * @var JsonHandler $jsonHandler The JSON handler.
         */
        private JsonHandler $jsonHandler;

        /**
         * @var Collection $collection The collection of blocks.
         */
        public Collection $collection;

        /**
         * Constructor.
         * 
         * @param string $json JSON to parse.
         * @return void
         */
        public function __construct(string $json)
        {
            // Parse JSON.
            $this->jsonHandler = new JsonHandler();
            $this->jsonHandler->setJson($json);

            // Create block collection.
            $rawBlocks = $this->jsonHandler->toArray()['blocks'];
            $this->collection = new Collection();
            foreach($$rawBlocks as $block)
            {
                $this->collection->insert(new Block($block));
            }
        }

        /**
         * Encodes the block collection to JSON.
         * 
         * @return string JSON data.
         */
        public function toJson()
        {
            $data = $this->jsonHandler->toArray();
            $data['blocks'] = $this->collection->toArray();
            $this->jsonHandler->setData($data);
            return $this->jsonHandler->toJson();
        }

        /**
         * Renders HTML from the block collection.
         * 
         * @param string $templatesPath Template path to use.
         * @return string HTML.
         */
        public function toHtml(string $templatesPath)
        {
            return $this->collection->toHTML($templatesPath);
        }
    }
}
