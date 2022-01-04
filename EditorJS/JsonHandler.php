<?php
namespace Megasteve19\EditorJS
{
    /**
     * Parses or generates JSON from EditorJS data.
     * 
     * @author megasteve19
     */
    class JsonHandler
    {
        /**
         * @var string The JSON string.
         */
        private string $json;

        /**
         * @var array The parsed JSON.
         */
        private array $data;

        /**
         * Constructor.
         * 
         * @return void
         */
        public function __construct()
        {
            $this->json = "{}";
            $this->data = [];
        }

        /**
         * Sets the JSON string.
         * 
         * @param string $json The JSON string.
         * @return void
         */
        public function setJson(string $json)
        {
            $this->json = $json;
            $this->data = $this->parseJson($json);
        }

        /**
         * Sets the data.
         * 
         * @param array $data The data.
         * @return void
         */
        public function setData(array $data)
        {
            $this->data = $data;
            $this->json = $this->generateJson($data);
        }

        /**
         * Parses the JSON string.
         * 
         * @param string $json The JSON string.
         * @return array The parsed JSON.
         */
        private function parseJson(string $json)
        {
            $data = json_decode($json, true);
            unset($data['time']);
            foreach($data['blocks'] as $key => $block)
            {
                unset($data['blocks'][$key]['id']);
            }
            return $data;
        }

        /**
         * Generates the JSON string.
         * 
         * @param array $data The data.
         * @return string The JSON string.
         */
        private function generateJson(array $data)
        {
            return json_encode($data);
        }

        /**
         * Returns the data.
         * 
         * @return array The data.
         */
        public function toArray()
        {
            return $this->data;
        }

        /**
         * Returns the JSON string.
         * 
         * @return string The JSON string.
         */
        public function toJson()
        {
            return $this->json;
        }
    }
}
