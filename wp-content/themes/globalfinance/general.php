<?php
/**
 * Template Name: Основная информация
 * */

$tempDir = get_template_directory_uri();

$domain = 'gfmsk-buhprofit.ru';
$mailbox = "info@$domain";

// Main company info
$company = [
    'city' => ['Москва', 'в Москве'],
    'name' => ['ИП', 'Юрьев Юрий Александрович'],
    'phones' => [['+79161201954', '+X (XXX) XXX-XX-XX']],
    'whatsapp' => ['79161201954', 'Наш WhatsApp'],
    'postcode' => '108850',
    'address' => 'ул. Папанина 47, офис 1',
    'reg' => 'ИНН: 540529598486,<br />ОГРН: 322774600651653.',
    'map' => [
        'geo' => '55.635747, 37.314966',
        'zoom' => '14',
    ],
    'ym' => '000000000',
    'domain' => $domain,
    'mailbox' => $mailbox,
    'worktime' => ['Режим работы:', 'ПН-ПТ: 9:00 - 18:00'],
];

// Second (lower) navigation bar
$navbarLinks = [
    'Услуги' => '/category/services/',
    'Цены' => '/buhservices/buh/',
    'Наша команда' => '/staff',
    'Партнёры' => '/partner',
    //'Новости'       => '/category/news/',
    'Контакты' => '/contacts',
];

// $social = [
//     [
//         'name'      => 'Вконтакте',
//         'icon-fa'   => $tempDir . '/images/social_signs/vk.svg',
//         'link'      => 'https://vk.com/id540103699'
//     ],
//     [
//         'name'      => 'Одноклассники',
//         'icon-fa'   => $tempDir . '/images/social_signs/ok.svg',
//         'link'      => 'https://ok.ru/profile/571791376759'
//     ],
//     [
//         'name'      => 'Инстаграм',
//         'icon-fa'   => $tempDir . '/images/social_signs/ig.svg',
//         'link'      => 'https://www.instagram.com/analitikabiznes/'
//     ]
// ];

$countries = [
    ['/images/flags/4x3/ru.svg', 'Россия'],
    ['/images/flags/4x3/by.svg', 'Беларусь'],
    ['/images/flags/4x3/kz.svg', 'Казахстан'],
    ['/images/flags/4x3/uz.svg', 'Узбекистан'],
    ['/images/flags/4x3/ki.svg', 'Киргизия'],
];

$footerLinks = [
    'Наши партнёры' => '/partner',
    'Штат бухгалтеров' => '/staff',
    // 'Вакансии' => '/category/vacancies',
    'Согласие на обработку ПД' => '/opd',
    // 'Реквизиты компании' => '/reg',
    // 'Сертификат соответствия' => '/cert',
    // 'СОУТ'                      => '/sout',
    'Контакты' => '/contacts',
];

$calcPrices = [
    6000, 7000, 7000, 10000,
    7600, 8600, 7000, 12000,
    10000, 10000, 7000, 15000,
];
