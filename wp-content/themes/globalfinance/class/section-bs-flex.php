<?php
/**
 * Creates bootstrap section with flex row division of w-100 splitter
 */
require_once 'section-bs.php';

class SectionFlex extends SectionBS
{
    function makeRowOfCols($row, $returnForUse = false)
    {
        $blockProperties['numberOfColumns'] = count($row);
        $blockProperties['factor'] = 12 / $blockProperties['numberOfColumns'];
        $blockProperties['minheight'] = $this->getminHeight();
        $blockProperties['css'] = 'class="flex-item"';

        $outPut[] = '<div class="flex-items-wrapper">';

        $outPut[] = array_reduce(
            $row,
            function ($acc, $data) use ($blockProperties) {
                $col = new SingleFlex($data, $blockProperties);
                $acc .= $col->buildCol();
                    return $acc;
            }, ''
        );

        $outPut[] = '</div>';
        return ($returnForUse) ? implode('', $outPut) : print_r(implode('', $outPut));
    }
}

