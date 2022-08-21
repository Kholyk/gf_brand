<?php
/**
 * Creates bootstrap section
 */
require_once 'wrapper.php';

class SectionBSChunks extends SectionBS
{
    function __construct($data)
    {
        // Apply parent constructor from SectionBS
        parent::__construct($data);

        // Number of items (singles) in chunk
        $this->itemsInChunk = checkAndReplace($this->data, 'chunk', 3);

        // split into chunks
        $this->chunks = array_chunk($this->columns, $this->itemsInChunk);
    }

    public function getSection() {
        $section = [];
        $section[] = '<div' . $this->idAttr . $this->classAttr . $this->styleAttr . '>';

            $section[] = '<div class="container module-container">' . $this->blockTitle . $this->blockDesc;
            $section[] = implode('', $this->splitToRows($this->chunks, [$this, 'getRowOfCols']));
            $section[] = '</div>';
        
        $section[] = '</div>';
        return $section;
    }

    private function splitToChunks($arr, $funcForCreate)
    {
            $chunksForRender = array_chunk($arr, $this->itemsInChunk);
            return array_map($funcForCreate, $chunksForRender);
    }

    function makeRowOfCols($row, $returnForUse = false)
    {
        $blockProperties['numberOfColumns'] = $this->fixedNumOfCols ? $this->cols : count($row);
        $blockProperties['factor'] = 12 / $blockProperties['numberOfColumns'];
        $blockProperties['minheight'] = $this->getminHeight();
        $blockProperties['col'] = 'class="col-lg-'
            . $blockProperties['factor']
            . ' col-md-'
            . $blockProperties['factor']
            . ' col-sm-12 col-12"';

        $outPut[] = '<div class="row">';

        $outPut[] = array_reduce(
            $row,
            function ($acc, $chunk) use ($blockProperties) {
                $col = new SingleChunk($chunk, $blockProperties);
                $acc .= $col->buildCol();
                    return $acc;
            }, ''
        );

        $outPut[] = '</div>';
        return ($returnForUse) ? implode('', $outPut) : print_r(implode('', $outPut));
    }
}

