<?php
/**
 * Template Name: Основная информация
 * */

$tempDir = get_template_directory_uri();

// Main company info
$company = [
    'city' => ['Мурманск', 'в Мурманске'],
    'postcode' => '183038',
    'name' => ['ООО', 'ФИНАНСКОНСАЛТ'],
    'phones' => [['+79113006464', '+7 (XXX) XXX-XX-XX'],['+78152706464', '+7 (XXXX) XX-XX-XX']],
    'whatsapp' => ['79113006464', 'Наш WhatsApp'],
    'worktime' => ['Режим работы:', 'ПН-ПТ: 9:00 - 18:00'],
    'domain' => 'finance51.ru',
    'mailbox' => 'info@finance51.ru',
    'ym' => '000000000',
    'address' => 'ул. Папанина 47, офис 1',
    'reg' => 'ИНН: 5190061537,<br />ОГРН: 1165190057647.',
    'map' => [
        'geo' => ['68.980833', '33.095741'],
        'zoom' => '14',
    ],
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
    ['/images/flags/4x3/by.svg', 'Белоруссия'],
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
