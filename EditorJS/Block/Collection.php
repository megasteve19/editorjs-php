<?php

namespace Megasteve19\EditorJS\Block;
{
    /**
     * Block collection to handle multiple blocks.
     * 
     * @author megasteve19
     */
    class Collection
    {
        /**
         * @var Block[] Blocks to handled.
         */
        private array $blocks;

        /**
         * Block collection constructor.
         * 
         * @param array $blocks Blocks to parse.
         * @return void
         */
        public function __construct(array $blocks)
        {
            foreach($blocks as $block)
            {
                $this->blocks[] = new Block($block);
            }
        }

        /**
         * Get all blocks.
         * 
         * @return Block[] Array of blocks.
         */
        public function all()
        {
            return $this->blocks;
        }

        /**
         * Returns all blocks by type.
         * 
         * @param string $type Type of blocks to return.
         * @return Block[] Array of blocks.
         */
        public function getBlocksByType(string $type)
        {
            $blocks = [];
            foreach($this->blocks as $block)
            {
                if($block->getType() === $type)
                {
                    $blocks[] = $block;
                }
            }
            return $blocks;
        }

        /**
         * Get block by id.
         * 
         * @param string $id Block id.
         * @return Block|null
         */
        public function find(string $id)
        {
            foreach($this->blocks as $block)
            {
                if($block->getId() === $id)
                {
                    return $block;
                }
            }
            return null;
        }

        /**
         * Insert a new block to collection.
         * 
         * @param Block $block Block to insert.
         * @return void
         */
        public function insert(Block $block)
        {
            $this->blocks[] = $block;
        }

        /**
         * Update a block by given block.
         * 
         * @param Block $newBlock Block to replace.
         * @return void
         */
        public function update(Block $newBlock)
        {
            foreach($this->blocks as $key => $block)
            {
                if($block->getId() === $newBlock->getId())
                {
                    $this->blocks[$key] = $newBlock;
                    return;
                }
            }
        }

        /**
         * Deletes a block by given block.
         * 
         * @param Block $blockToDelete Block to delete.
         */
        public function delete(Block $blockToDelete)
        {
            foreach($this->blocks as $key => $block)
            {
                if($block->getId() === $blockToDelete->getId())
                {
                    unset($this->blocks[$key]);
                    return;
                }
            }
        }

        /**
         * Returns count of blocks.
         * 
         * @return int Count of blocks.
         */
        public function count()
        {
            return count($this->blocks);
        }

        /**
         * Clears all blocks.
         * 
         * @return void
         */
        public function clear()
        {
            $this->blocks = [];
        }

        /**
         * Converts block collection to array.
         * 
         * @return array Array of blocks.
         */
        public function toArray()
        {
            $blocks = [];
            foreach($this->blocks as $block)
            {
                $blocks[] = $block->toArray();
            }
            return $blocks;
        }

        /**
         * Renders HTML of all blocks.
         * 
         * @param string $templatesPath Template path to use.
         * @return string HTML of all blocks.
         */
        public function toHTML(string $templatesPath)
        {
            $html = '';
            foreach($this->blocks as $block)
            {
                $html .= $block->toHTML($templatesPath . DIRECTORY_SEPARATOR . $block->getType() . '.php');
            }
            return $html;
        }
    }
}
