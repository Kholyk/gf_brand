<?php



/**
 * Checks whether key in array is set and not null
 */
function checkAndReplace($arrToCheck, $ifExists, $replaceToIt = '')
{
    return (array_key_exists($ifExists, $arrToCheck) && !empty($arrToCheck[$ifExists])) ? $arrToCheck[$ifExists] : $replaceToIt;
}



/**
 * Phone link creator
 */
function createPhoneLink($source, $class = '', $pattern = '+7 (XXX) XXX-XX-XX')
{
    if (gettype($source) == 'array') {
        if (count($source) == 2) {
            $pattern = $source[1];
        } 
        $source = $source[0];
    }
    $classTag = (!empty($class)) ? " class=\"$class\"" : '';
    $output = ["<a href=\"tel:$source\"$classTag>"];

    $patternSymbols = str_split($pattern);
    $phoneSymbols = str_split($source);
  
    $phoneSymbols = array_slice($phoneSymbols, 2);

    $digits = array_filter(
        $patternSymbols,
        function ($el) {
            return $el == 'X';
        }
    );

 
    $digitsArr = array_keys($digits);

    array_map(
        function ($key, $digit) use (&$patternSymbols) {
            $patternSymbols[$key] = $digit;
        },
        $digitsArr,
        $phoneSymbols
    );
    
    $output[] = implode('', $patternSymbols);
    $output[] = "</a>";

    return implode('', $output);
}


/**
 * Dispatcher by Object for classes
 * 
 * @return class Object
 */
function dispatch($section) {
    $dispatcher = [
        'topper'    => 'Topper', 
        'navbar'    => 'Navbar', 
        'wrapper'   => 'Wrapper',
        'bs'        => 'SectionBS', 
        'bs-hor'    => 'SectionBSHor',
        'bs-chunks' => 'SectionBSChunks',
        'flex'      => 'SectionFlex',       
        'bs-cards'  => 'SectionCard',
        'slider'    => 'Slider',            
        'tabs'      => 'Tabs'               
    ];
    if (array_key_exists($section['type'], $dispatcher)) {
        $class = $dispatcher[$section['type']];
        return new $class($section);
    }
}

?>
