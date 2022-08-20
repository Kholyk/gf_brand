<?php
/**
 * Creates bootstrap section
 */
require_once 'wrapper.php';

class SectionBS extends Wrapper
{
    function __construct($data)
    {
        // Apply parent constructor from Wrapper
        parent::__construct($data);

        // Add horizontal-wrapper to class section // OVERRIDE Wrapper's classAttr
        $classesArr[] = 'horizontal-wrapper';

        if (!empty($this->class)) {
            $classesArr[] = $this->class;
        }

        $this->classAttr = (count($classesArr) != 0) ? 
            ' class="' . implode(' ', $classesArr) . '"' : '';

        // columns (items of block)
        $this->columns = array_filter(
            $this->data, 
            function ($arr) {
                return gettype($arr) === 'array';
            }
        );
        
        $this->numberOfColumns = count($this->columns);

        $this->cols = checkAndReplace($this->data, 'cols', $this->numberOfColumns);
        $this->fixedNumOfCols = checkAndReplace($this->data, 'forcecols', false);
        $this->minHeight = checkAndReplace($this->data, 'minheight');
    }

    public function getSection()
    {
        $section = [];
        $section[] = '<div' . $this->idAttr . $this->classAttr . $this->styleAttr . '>';

            $section[] = '<div class="container module-container">' . $this->blockTitle . $this->blockDesc;
            $section[] = implode('', $this->splitToRows($this->columns, [$this, 'getRowOfCols']));
            $section[] = '</div>';
        
        $section[] = '</div>';
        return $section;
    }

    protected function getminHeight()
    {
        return $this->minHeight;
    }

    protected function splitToRows($arr, $funcForCreate)
    {
            $rowsForRender = array_chunk($arr, $this->cols);
            return array_map($funcForCreate, $rowsForRender);
    }

    protected function makeRowOfCols($row, $returnForUse = false)
    {
        $blockProperties['numberOfColumns'] = $this->fixedNumOfCols ? $this->cols : count($row);
        // print_r($blockProperties['numberOfColumns']);
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
                $col = new Single($data, $blockProperties);
                $acc .= $col->buildCol();
                    return $acc;
            }, ''
        );

        $outPut[] = '</div>';
        return ($returnForUse) ? implode('', $outPut) : print_r(implode('', $outPut));
    }

    protected function getRowOfCols($row)
    {
        return $this->makeRowOfCols($row, true);
    }
}

