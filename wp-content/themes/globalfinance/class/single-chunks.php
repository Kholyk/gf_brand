<?php
/**
 * Single column with chunks inside creator class
 * Class will be created using nested Single block as child chunk's item
 */
class SingleChunk
{
    function __construct($chunkBlock, $itemProps)
    {
        $this->chunkBlock = $chunkBlock;
        $this->itemProps = $itemProps;
    }

    public function buildCol()
    {
        $outPutBlock[] = '<div '. $this->itemProps['col'] . '><chunk class="row">';
        $result = array_map(
            function ($chunkItem)
            {
                $this->itemProps['css'] = ' class="module-item col-12" ';
                $currentItem = new Single($chunkItem, $this->itemProps);
                return $currentItem->buildCol();
            },
            $this->chunkBlock
        );

        $outPutBlock[] = implode('', $result);
        $outPutBlock[] = '</chunk></div>';
        return implode('', $outPutBlock);
    }
}