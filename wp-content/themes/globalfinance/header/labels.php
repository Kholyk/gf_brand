<?php ?>
<labels>
    <?php
    $termname = explode('/', parse_url($_SERVER['REQUEST_URI'])['path'])[1];
    $currentTerm = get_term_by('id', get_queried_object()->term_id, $termname);
    $currentTermName = get_term_by('id', get_queried_object()->term_id, $termname)->name;
    

    $parentChain = get_term_parents_list(get_queried_object()->term_id, $termname, array(
        'separator' => '/',
        'format' => 'name',
        //'inclusive' => false,
        'link' => false,
    ));

    $parentURI = explode('/', $parentChain)[0];
    $parentTerm = get_term_by('name', $parentURI, $termname);
    $parentID = $parentTerm->term_id;
    
    //print_r('<h1>'.$parentTerm->name.' '.$currentTermName.'</h1>');
    //print_r($parentTerm->description);

    $termchildren = get_term_children(get_queried_object()->term_id, $termname);

    if (!empty($termchildren)) {
        $terms = get_terms($termname, [
            'hide_empty' => false,
            'pad_counts' => true,
            'child_of' => get_queried_object()->term_id
        ]);
    } else {
        $terms = get_terms($termname, [
            'hide_empty' => false,
            'pad_counts' => true,
            'parent' => $parentID,
        ]);
    }


    if ($terms && !is_wp_error($terms)):
        foreach ($terms as $term):
            $categorylink = get_term_link($term->slug, $term->taxonomy);
            $currentSlug = explode('/', parse_url($_SERVER['REQUEST_URI'])['path'])[2];
            $activeNow = ($currentSlug == $term->slug) ? 'btn-danger' : 'btn-info';
            ?>
            <a href="<?= $categorylink; ?>" class="btn btn-sm <?= $activeNow; ?>"><?= $term->name ?> <span class="badge badge-warning"><?= $term->count ?></span></a>

            <?php
        endforeach;
    endif;
    ?>
</labels>
