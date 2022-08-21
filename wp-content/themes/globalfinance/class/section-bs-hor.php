<?php
/**
 * Creates bootstrap section
 */
require_once 'wrapper.php';

class SectionBSHor extends SectionBS
{
    function makeRowOfCols($row, $returnForUse = false)
    {
        $blockProperties['numberOfColumns'] = $this->fixedNumOfCols ? $this->cols : count($row);
        $blockProperties['factor'] = 12 / $blockProperties['numberOfColumns'];
        $blockProperties['minheight'] = $this->getminHeight();
        $blockProperties['css'] = 'class="module-item col-lg-'
            . $blockProperties['factor']
            . ' col-md-'
            . $blockProperties['factor']
            . ' col-sm-12 col-12"';

        $outPut[] = '<div class="row">';

        $outPut[] = array_reduce(
            $row,
            function ($acc, $data) use ($blockProperties) {
                $col = new SingleHorizontal($data, $blockProperties);
                $acc .= $col->buildCol();
                    return $acc;
            }, ''
        );

        $outPut[] = '</div>';
        return ($returnForUse) ? implode('', $outPut) : print_r(implode('', $outPut));
    }
}

