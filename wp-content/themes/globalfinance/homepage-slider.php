<?php

// Determine month
$month = date('n');
$monthsNames = [
    'январе',
    'феврале',
    'марте',
    'апреле',
    'мае',
    'июне',
    'июле',
    'августе',
    'сентябре',
    'октябре',
    'ноябре',
    'декабре'];

    $daysleftinMonth = date('t') - date('j');

    $daysLeft = ($daysleftinMonth == 0) ? 'последний' : $daysleftinMonth;
    $pre = 'осталось';

if ($daysLeft == 1 || $daysLeft == 0 || $daysLeft == 21 || $daysLeft == 31) {
        $ofDays = 'день';
        $pre = 'остался';
} elseif ($daysLeft > 1 && $daysLeft < 5 || $daysLeft > 21 && $daysLeft < 25) {
        $ofDays = 'дня';
} else {
        $ofDays = 'дней';
}


    $homePageSlider = [
        'type' => 'slider',
        'anchor' => 'homepageSlider     ',
        'duration' => 5000,
        'button_class' => 'd-none btn btn-warning text-dark',
        'button' => false,
        'class' => 'd-none d-md-block',
        'h2' => 'Акции компании',
        'h3' => 'Спеши приобрести',
        'bg' => ''];

    $counter = 0;

    $slides = new WP_Query(
        [
        'category_name' => 'slides-main-page'
        ]
    );

    if ($slides->have_posts()) {
        while ($slides->have_posts()) {
            $slides->the_post();
            $curPostId = $post->ID;
            $isActive = $counter === 0 ? 'active' : $counter;
            array_push(
                $homePageSlider, [
                'tag' => $isActive,
                'button_txt' => '',
                'img' => get_the_post_thumbnail_url($curPostId, 'full'),
                'logo' => '/wp-content/uploads/logo/logo-string-black.svg',
                'heading' => get_the_title(),
                'desc' => get_the_content(),
                'button' => [
                    'text'   => 'Заказать услугу &laquo;'.get_the_title().'&raquo; (' . $pre . ' ' . $daysLeft . ' ' . $ofDays . ')',
                    'target' => '#myModal'
                ]
                ]
            );
            $counter += 1;
        }
    }

        $parsedSlider = new Slider($homePageSlider);
        print_r(implode('', $parsedSlider->getSection()));
