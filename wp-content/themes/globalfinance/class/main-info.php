<?php
require 'config/general.php';

$mainConfig = unserialize(file_get_contents('config/s_serialized.php'));
$theme = $mainConfig['sliderIsLight'] ? 'light' : 'dark';

// MAIN INFO

$loc = (isset($_GET['p']) && $_GET['p'] == 'eng') ? 'eng' : 'rus';

$okMark = array_key_exists('email', $_SESSION) ? '<hr><div class="alert alert-success" role="alert"><i class="text-success fa fa-check-circle" aria-hidden="true"></i> <b>'
. $_SESSION['name'] .'</b>, '
. $entDetails['requestSent'].' &laquo;'. $entDetails['name'][$loc].'&raquo;!<br />'
. $entDetails['willcontact'] .' '. $_SESSION['tel']. ' '. $entDetails['inWhatTime'].'</div>': '';

// create all needed fields
$geo_headline = getLocaleString($entDetails['geoHeadline'], $loc);
$geo_subheadline = getLocaleString($entDetails['geoSubHeadline'], $loc);
$geo_company  = getLocaleString($entDetails['type'], $loc) . ' &laquo;' . getLocaleString($entDetails['name'], $loc) . '&raquo;';

    // Composing address
    $curPostcode = !empty($entDetails['postcode']) ? $entDetails['postcode'] . ', ' : '';
    $curCity = getLocaleString($entDetails['city'], $loc);
    $curAddr = getLocaleString($entDetails['address'], $loc);

    $geo_address_array = [$curCity];
    if (!empty($curAddr)) {
        $geo_address_array[] = $curAddr;
    }

    $geo_address = $curPostcode . $mainLocale['g'][$loc] . ' ' . implode(', ', $geo_address_array) . '.';

    // E-Mail
    $cur_email = $entDetails['email'] . '@' . $entDetails['domain'];
    $geo_email = "<a href=\"mailto:$cur_email\">$cur_email</a>";



    // Phone Block
    $geo_phone_array = array_map(
        function ($phone) {
            return '<i class="orange fas fa-phone-square"></i> ' . createPhoneLink($phone);
        },
        $entDetails['phone']
    );
    $geo_phones = '<p>' . implode(',<p> ', $geo_phone_array) . '.';
    $geo_phones_string = '<p class="text-white">' . implode(', ', $geo_phone_array) . '.</p>';

    // Phone block

    // Starting Social block
    $geo_socialBlock = '';
    if (array_key_exists('social', $entDetails)) {
        $result[] = '<h4 class="social"><b>' . $mainLocale['social'][$loc] . ':</b></h4><p>';

        $innerBlock = array_map(
            function ($group) {
                return '<a href="'.$group['link'].'"> <i class="' . $group['icon-fa'] . '"></i> <span class="social_link">' . $group['name'] . '</span></a>';
            },
            $entDetails['social']
        );

        $result[] = implode('  | ', $innerBlock);
        $result[] = '</p>';

        $geo_socialBlock = implode('', $result);
    }

    $footer_socialBlock = '';
    if (array_key_exists('social', $entDetails)) {
        $resultFooter[] = '<p>';

        $footerBlock = array_map(
            function ($group) {
                return '<a href="'.$group['link'].'"> <i class="' . $group['icon-fa'] . '" style="color:#fff;"></i> <span class="social_link">' . $group['name'] . '</span></a>';
            },
            $entDetails['social']
        );

        $resultFooter[] = implode('  | ', $footerBlock);
        $resultFooter[] = '</p>';

        $footer_socialBlock = implode('', $resultFooter);
    }
    // Ending social block

    // Copyrights
    $geo_copyrights = '<p>' . getLocaleString($mainLocale['copyright'], $loc) . '</p>';

    // Current Version
    $geo_version = $version[0] . ' | ' . $version[1];

    $request = getLocaleString($mainLocale['request'], $loc);
    $sent = getLocaleString($mainLocale['sent'], $loc);
    $wait = getLocaleString($mainLocale['wait'], $loc);
    $wait_for_call = getLocaleString($mainLocale['wait_for_call'], $loc);


    //Forms


// MAIN INFO
