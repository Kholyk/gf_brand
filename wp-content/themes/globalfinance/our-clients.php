<?php

$terms = get_terms(
    [
    'taxonomy' => 'partners',
    'hide_empty' => false
    ]
);

$homeURL = get_home_url();

$tabs = [
    'type' => 'tabs',
    'active' => 1,
    'anchor' => 'tabs',
    'h2' => 'Наши партнеры',
    'h3' => 'Банки и организации',
];

foreach($terms as $key => $term) {
    $fromPostsOfTerm = getPostsDataForSlugTab(
        'partners', $term->slug, [
            'img' => true,
            'heading' => true,
            'desc' => true
        ]
    );

    $tabsBlock = [
        'type' => 'bs',
        'cols' => 4,
        'anchor' => $term->slug,
        'tabswitch' => $key, 
        'tabheading' => $term->name,
        'forcecols' => true,
    ];

    foreach ($fromPostsOfTerm as $item) {
        $tabsBlock[] = $item;
    }

    $tabs[] = $tabsBlock;
} 


// print_r($tabs);
?>

<div class="row">
   <div class="col-xl-6 col-md-6 d-none d-sm-block"><a href="#"><img src="<?=$homeURL?>/wp-content/themes/globalfinance/images/bt.jpg" alt="" width="100%"></a></div>
<!--    <div class="col-xl-6 col-md-6 d-none d-sm-block"><a href="#" class="partner-app-ad">
	   <img src="https://partner.alfabank.ru/api/banners/getImgUrl?id=92c8231d-babe-493b-acba-7e88f9f02341" alt="alfa-ad" width="100%"/></a>
	</div> -->
	<div class="col-xl-6 col-md-6 d-none d-sm-block"><a href="#">
		<img src="<?=$homeURL?>/wp-content/themes/globalfinance/images/tinkoff.png" alt="" width="100%"></a>
	</div>

</div>&nbsp;<br />


&nbsp;<br />

<?php
$tabsPartners = new Tabs($tabs);
print_r(implode('', $tabsPartners->getSection()));
?>
