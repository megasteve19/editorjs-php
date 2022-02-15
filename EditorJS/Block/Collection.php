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
         * @param Block[]|null $blocks [Optional] Blocks to handle.
         * @return void
         */
        public function __construct(?array $blocks = null)
        {
            $this->blocks = $blocks ?? [];
        }

        /**
         * Get all blocks.
         * 
         * @param string $type [Optional] Type of blocks to get.
         * @return Collection Collection of blocks.
         */
        public function all(string $type = null)
        {
            if(!empty($type))
            {
                $filteredBlocks = [];
                foreach($this->blocks as $block)
                {
                    if($block->type === $type)
                    {
                        $filteredBlocks[] = $block;
                    }
                }
                return new Collection($filteredBlocks);
            }
            new Collection($this->blocks);
        }

        /**
         * Get block by index.
         * 
         * @param int $index Index of block to get.
         * @return Block|null Block.
         */
        public function get(int $index)
        {
            if(isset($this->blocks[$index]))
            {
                return $this->blocks[$index];
            }
            return null;
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
                if($block->id === $id)
                {
                    return $block;
                }
            }
            return null;
        }

        /**
         * Add a new block to collection.
         * 
         * @param Block $block Block to add.
         * @return void
         */
        public function add(Block $block)
        {
            $this->blocks[] = $block;
        }

        /**
         * Update block by given block.
         * 
         * @param Block $blockToUpdate Block to update.
         * @return void
         */
        public function update(Block $blockToUpdate)
        {
            foreach($this->blocks as $key => $block)
            {
                if($block->id === $blockToUpdate->id)
                {
                    $this->blocks[$key] = $blockToUpdate;
                }
            }
        }

        /**
         * Remove block by given block.
         * 
         * @param Block $block Block to delete.
         */
        public function remove(Block $block)
        {
            foreach($this->blocks as $key => $block)
            {
                if($block->id === $block->id)
                {
                    unset($this->blocks[$key]);
                }
            }
        }

        /**
         * Append blocks by given collection.
         * 
         * @param Collection $collection Collection to append.
         * @return void
         */
        public function append(Collection $collection)
        {
            foreach($collection->blocks as $block)
            {
                $this->add($block);
            }
        }

        /**
         * Replace blocks by given collection.
         * 
         * @param Collection $collection Collection to replace.
         * @return void
         */
        public function replace(Collection $collection)
        {
            foreach($collection->blocks as $block)
            {
                $this->update($block);
            }
        }

        /**
         * Clears all blocks or blocks by given collection.
         * 
         * @param Collection|null $collection [Optional] Collection to clear.
         * @return void
         */
        public function clear(?Collection $collection = null)
        {
            if(!empty($collection))
            {
                foreach($collection->blocks as $block)
                {
                    $this->remove($block);
                }
                return;
            }
            $this->blocks = [];
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
                $html .= $block->toHTML($templatesPath . DIRECTORY_SEPARATOR . $block->type . '.php');
            }
            return $html;
        }
    }
}
