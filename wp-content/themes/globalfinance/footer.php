<?php

require 'general.php';

$tempDir = get_template_directory_uri();

function makePhoneLinks($arr, $class = 'text-white text-bold')
{
    $phonesArr = array_map(
        function ($phone) use ($class) {
            $phoneLink = createPhoneLink($phone, $class);
                return $phoneLink;
        },
        $arr
    );
    return $phones = implode('<br />', $phonesArr);
}



?>
</content>

<foot class="container-fluid" style="background:#eee;">
    <div class="container">
        <sect class="row">
            <first class="col-lg-3 col-md-3 col-sm-12 d-none d-sm-block">
                <img src="/wp-content/uploads/logo/logo-string-white.svg" style="margin:20px 0 0px 0;width:80%;">
            </first>
            <second id="countries" class="col-lg-7 col-md-6 col-sm-12 d-none d-md-block">
                <h5 class="text-dark top">Страны присутствия:</h5>
                    <p class="text-dark">
                    <?php
                        $countriesArr = array_reduce(
                            $countries,
                            function ($result, $country) use ($tempDir) {
                                $result[] = '<img src="' . $tempDir . $country[0] . '"> ' . $country[1];
                                return $result;
                            },
                            []
                        );

                        print_r(implode('', $countriesArr));
                    ?>
                    </p>
            </second>

            <fourth class="sb-footer col-lg-2 col-md-2 col-sm-12 d-none d-sm-flex">
            <?php
            array_map(
                function ($socLink) {
                    print_r('<a href="' . $socLink['link'] . '"><img class="socsign" src="' . $socLink['icon-fa'] . '"></a>');
                },
                isset($social) ? $social : []
            );
            ?>
            </fourth>
        </sect>
    </div>
</foot>

<foot class="container-fluid"><div class="container">
    <sect class="row">
        <first class="col-lg-3 col-md-3 col-sm-12">
        <h5 class="font-weight-light">Координаты:</h5>
            <p>Бухгалтерский учет<br />и аудит
            «Global Finance» ®</p><p>
            <?php 
            print_r($company['postcode'] . ', г. '.$company['city'][0] . ',<br />' . $company['address']);
            ?></p><p>
            <?=makePhoneLinks($company['phones'], 'text-white text-bold')?>
        </p><p>
            <a class="footlink" href="mailto:<?=$company['mailbox']?>">Написать письмо на почту</a>
            </p>
        </first>

        <second class="col-lg-6 col-md-6 col-sm-12">
            <h5 class="font-weight-light">Услуги компании:</h5>
           <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-12"><p>
               <?php
               $servicesOfCompany = new WP_Query([
                    'posts_per_page' => 12,
                    'category_name' => 'services'
                    ]);
                    $counter = 0;
                    if ( $servicesOfCompany->have_posts() ) : while ( $servicesOfCompany->have_posts() ) : $servicesOfCompany->the_post();?>
                    <?php
                    print_r('<a class="footlink" href="'.get_the_permalink().'">'.get_the_title().'</a><br />');
                        $counter += 1;
                        if ($counter === 4) {
                            print_r('</p></div><div class="col-lg-6 col-md-6 col-sm-12"><p>');
                        }
                        endwhile;

                        ?>
                    <?php endif; ?>
                    </p></div>
           </div>
        </second>

        <fourth class="col-lg-3 col-md-3 col-sm-12 d-none d-sm-block">
            <h5 class="font-weight-light">О компании:</h5>
            <p>
            <?php
                array_map(
                    function ($name, $destination) {
                        print_r('<a class="footlink"  href="' . get_home_url() . $destination . '">' . $name . '</a><br />');
                    },
                    array_keys($footerLinks),
                    $footerLinks
                );
            ?>
            </p>
        </fourth>

    </sect>
    <copyright class="row">
        <div class="col-12">
            <?=$company['reg']?><br />
            Зарегистрированный товарный знак № 594395.<br />Незаконное использование товарного знака влечет за собой гражданскую, административную и уголовную ответственность (ст.1515 ГК РФ, ст. 14.10. КоАП РФ, ст.180 УК РФ).
        </div>
    </copyright>
</div>
</foot>
<?php wp_footer(); ?>
<script>


// Reach goals
$("#wpcf7-f6151-o1").on('submit', event => {
  ym(52997341, 'reachGoal', 'REQUEST');
  return true;
});

$("#callback_phone").on('click', event => {
  ym(52997341, 'reachGoal', 'CALLBACK');
  return true;
});

</script>
<script src="<?=$tempDir ?>/assets/lightbox/js/lightbox.min.js"></script>

<!-- API Yandex maps -->
<?php
    $mapArray = $company['map'];
    $mapProps['geo'] = $mapArray['geo'];
    $mapProps['zoom'] = isset($mapArray['zoom']) ? $mapArray['zoom'] : 10;
    $mapProps['center'] = isset($mapArray['center']) ? $mapArray['center'] : $mapProps['geo'];
    // print_r($mapProps);
?>
<script type="text/javascript">
    ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: ['<?=$mapProps['center'][0]?>','<?=$mapProps['center'][1]?>'],
            zoom: '<?=$mapProps['zoom']?>'
        });
        companyPoint = new ymaps.Placemark(['<?=$mapProps['geo'][0]?>','<?=$mapProps['geo'][1]?>'] , {
            balloonContentBody: '<img src="/wp-content/uploads/logo/logo-string-white.svg" height="30px" width="100px"> <br /> ' +
            '<b><?=$company['name'][0]?> &laquo;<?=$company['name'][1]?>&raquo;</b><br />' +
            '<?=makePhoneLinks($company['phones'], 'text-success text-bold')?>',

        });
    myMap.geoObjects
        .add(companyPoint);
    companyPoint.balloon.open();
});        
</script>
<!-- API Yandex maps -->


</body>
</html>
