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
         * @param string $type [Optional] Type of blocks to get.
         * @return Block[] Array of blocks.
         */
        public function all(string $type = null)
        {
            if(!empty($type))
            {
                $filteredBlocks = [];
                foreach($this->blocks as $block)
                {
                    if($block->getType() === $type)
                    {
                        $filteredBlocks[] = $block;
                    }
                }
                return $filteredBlocks;
            }
            return $this->blocks;
        }

        /**
         * Returns all blocks by type.
         * 
         * @param string $type Type of blocks to return.
         * @return Block[] Array of blocks.
         * @deprecated Use `all()` instead.
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
         * Insert a new block or blocks to collection.
         * 
         * @param Block|array $block Block or blocks to insert.
         * @return void
         */
        public function insert(array|Block $block)
        {
            if(is_array($block))
            {
                return $this->insertMultiple($block);
            }
            return $this->insertSingle($block);
        }

        /**
         * Inserts single block to collection.
         * 
         * @param Block $block Block to insert.
         * @return void
         */
        private function insertSingle(Block $blockToInsert)
        {
            if(empty($this->find($blockToInsert->getId())))
            {
                $this->blocks[] = $blockToInsert;
            }
        }

        /**
         * Insert blocks to collection.
         * 
         * @param Block[] $blocks Blocks to insert.
         * @return void
         */
        private function insertMultiple(array $blocks)
        {
            foreach($blocks as $block)
            {
                $this->insertSingle($block);
            }
        }

        /**
         * Update block or blocks by given block or blocks of array.
         * 
         * @param Block|Block[] $block Block or blocks to update.
         * @return void
         */
        public function update(array|Block $block)
        {
            if(is_array($block))
            {
                return $this->updateMultiple($block);
            }
            return $this->updateSingle($block);
        }

        /**
         * Updates a block by given block.
         * 
         * @param Block $blockToUpdate Block to update.
         * @return void
         */
        private function updateSingle(array|Block $blockToUpdate)
        {
            foreach($this->blocks as $key => $block)
            {
                if($block->getId() === $blockToUpdate->getId())
                {
                    $this->blocks[$key] = $blockToUpdate;
                    return;
                }
            }
        }

        /**
         * Update blocks by given array of blocks.
         * 
         * @param Block[] $blocks Blocks to update.
         * @return void
         */
        private function updateMultiple(array $blocks)
        {
            foreach($blocks as $block)
            {
                $this->updateSingle($block);
            }
        }

        /**
         * Delete block or blocks by given block or blocks of array.
         * 
         * @param Block|Block[] $block Block or blocks to delete.
         */
        public function delete(array|Block $block)
        {
            if(is_array($block))
            {
                return $this->deleteMultiple($block);
            }
            return $this->deleteSingle($block);
        }

        /**
         * Deletes a block by given block.
         * 
         * @param Block|Block[] $blockToDelete Block or blocks to delete.
         */
        private function deleteSingle(array|Block $blockToDelete)
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
         * Delets blocks by given array of blocks.
         * 
         * @param Block[] $blocks Blocks to delete.
         * @return void
         */
        private function deleteMultiple(array $blocks)
        {
            foreach($blocks as $block)
            {
                $this->deleteSingle($block);
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
