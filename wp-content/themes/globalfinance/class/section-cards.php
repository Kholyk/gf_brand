<?php
/**
 * Creates bootstrap section with flex row division of w-100 splitter
 */
require_once 'section-bs.php';

class SectionCard extends SectionBS
{
    function makeRowOfCols($row, $returnForUse = false)
    {
        $blockProperties = [];
        $outPut[] = '<div class="card-deck">';

        $outPut[] = array_reduce(
            $row,
            function ($acc, $data) use ($blockProperties) {
                $col = new SingleCard($data, $blockProperties);
                $acc .= $col->buildCol();
                    return $acc;
            }, ''
        );

        $outPut[] = '</div>';
        return ($returnForUse) ? implode('', $outPut) : print_r(implode('', $outPut));
    }
}

