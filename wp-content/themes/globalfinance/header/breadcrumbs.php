<?php
// For plasma
global $currentTermName;
function buildBreadcrumbs($terID) {

    function iter($termID, $acc) {
        $curTerm = get_term($termID);
        array_push($acc, '<a href="' . get_term_link($curTerm) . '">' . $curTerm->name . '</a>');

        if (!$curTerm->parent) {
            array_push($acc, '<a href="' . get_home_url() . '">Главная</a>');
            return $acc;
        }

        return iter($curTerm->parent, $acc);
    }
    // For plasma
    global $currentTermName;
    $reversed = iter($terID, []);
    $currentTermName = $reversed[0];
    // For plasma

    return print_r(implode(' &rarr; ', array_reverse($reversed)));
}


//buildBreadcrumbs(36);

function breadcrumb() {

    global $post;
    //try to determine HTTP_REFERER
    $current_taxonomy = explode('/',parse_url($_SERVER['REQUEST_URI'])['path'])[1].'s';
    $defined_terms = wp_get_post_terms($post->ID, $current_taxonomy); // вытаскиваем ID элементов, присвоенных посту


    if ($defined_terms) {
        function hasParents($item) {
           return ($item->parent != 0);
        }

        $hasParents = array_filter($defined_terms, 'hasParents');
        
        if (count($hasParents) == 0) {
            return buildBreadcrumbs(array_shift($defined_terms)->term_id);
        }
        
        
        
        return buildBreadcrumbs(array_shift($hasParents)->term_id);
    }
}

breadcrumb();



