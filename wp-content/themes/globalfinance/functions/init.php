<?php

add_action('init', 'my_custom_post_types');
function my_custom_post_types() {

	global $wp_rewrite;

	register_post_type('partner', [
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'publicly_queryable' => true,
		'menu_position' => 11,
		'supports' => array('title', 'thumbnail', 'editor'),
		'has_archive' => true,
		'rewrite' => true,
		'menu_icon' => 'dashicons-editor-help',
		
		'labels' => [
		        'name' => 'Партнёры',
		        'singular_name' => 'Партнёр',
		        'add_new' => 'Добавить партнёра',
		        'add_new_item' => 'Добавить партнёра',
		        'edit_item' => 'Редактировать партнёра',
		        'new_item' => 'Новый партнёр',
		        'all_items' => 'Все партнёры',
		        'view_item' => 'Просмотр партнёра',
		        'search_items' => 'Искать партнёра',
		        'not_found' =>  'Не найдено партнёров',
		        'not_found_in_trash' => 'Не найдено партнёров в корзине', 
		        'parent_item_colon' => '',
		        'menu_name' => '--- ПАРТНЁРЫ'
		]
	]);

	register_taxonomy('partners', ['partner'], [
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'sort' => true,
			'show_in_nav_menus' => false,
			
			'rewrite' => [
				'slug' => 'partners',
				'with_front' => false
			],
			'show_admin_column' => true,
			
			'labels' => [
				'name' => 'Категории партнёров',
				'singular_name' => 'Категория',
				'new_item_name' => 'Добавить категорию',
				'all_items' => 'Все',
				'edit_item' => 'Редактировать категорию',
				'update_item' => 'Обновить категорию',
				'add_new_item' => 'Добавить категорию',
				'new_item_name' => 'Название категории',
				'view_item' => 'Перейти к категории',
				'search_items' => 'Искать категорию',
				'not_found' =>  'Не найдено категорий партнёров',
			]
		]
	);

	register_post_type('buhservice', [
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'publicly_queryable' => true,
		'menu_position' => 11,
		'supports' => array('title', 'thumbnail', 'editor'),
		'has_archive' => true,
		'rewrite' => true,
		'menu_icon' => 'dashicons-editor-help',
		
		'labels' => [
		        'name' => 'Бухуслуги',
		        'singular_name' => 'Бухгалтерская услуга',
		        'add_new' => 'Добавить бухуслугу',
		        'add_new_item' => 'Добавить бухуслугу',
		        'edit_item' => 'Редактировать бухуслугу',
		        'new_item' => 'Новая бухуслуга',
		        'all_items' => 'Все бухуслуги',
		        'view_item' => 'Просмотр бухуслуги',
		        'search_items' => 'Искать бухуслугу',
		        'not_found' =>  'Не найдено бухуслуг',
		        'not_found_in_trash' => 'Не найдено бухуслуг в корзине', 
		        'parent_item_colon' => '',
		        'menu_name' => '--- БУХУСЛУГИ'
		]
	]);

	register_taxonomy('buhservices', ['buhservice'], [
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'sort' => true,
			'show_in_nav_menus' => true,
			
			'rewrite' => [
				'slug' => 'buhservices',
				'with_front' => false
			],

			'show_admin_column' => true,
			
			'labels' => [
				'name' => 'Категории бухуслуг',
				'singular_name' => 'Категория',
				'new_item_name' => 'Добавить категорию бухуслуг',
				'all_items' => 'Все бухуслуги',
				'edit_item' => 'Редактировать категорию бухуслуг',
				'update_item' => 'Обновить категорию бухуслуг',
				'add_new_item' => 'Добавить категорию бухуслуг',
				'new_item_name' => 'Название категории бухуслуг',
				'view_item' => 'Перейти к категории бухуслуг',
				'search_items' => 'Искать категорию бухуслуг',
				'not_found' =>  'Не найдено категорий бухуслуг',
			]
		]
	);

	register_post_type('staff', [
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'publicly_queryable' => true,
		'menu_position' => 11,
		'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
		'has_archive' => true,
		'rewrite' => true,
		//'menu_icon' => 'dashicons-editor-help',
		
		'labels' => [
		        'name' => 'Работники',
		        'singular_name' => 'Работник',
		        'add_new' => 'Добавить работника',
		        'add_new_item' => 'Добавить работника',
		        'edit_item' => 'Редактировать работника',
		        'new_item' => 'Новый работник',
		        'all_items' => 'Все работники',
		        'view_item' => 'Просмотр работника',
		        'search_items' => 'Искать работника',
		        'not_found' =>  'Не найдено работников',
		        'not_found_in_trash' => 'Не найдено работников в корзине', 
		        'parent_item_colon' => '',
		        'menu_name' => '--- РАБОТНИКИ'
		]
	]);

	register_taxonomy('department', ['staff'], [
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'sort' => true,
			'show_in_nav_menus' => true,
			
			'rewrite' => [
				'slug' => 'department',
				'with_front' => false
			],

			'show_admin_column' => true,
			
			'labels' => [
				'name' => 'Отделы',
				'singular_name' => 'Отдел',
				'new_item_name' => 'Добавить отдел',
				'all_items' => 'Все отделы',
				'edit_item' => 'Редактировать отдел',
				'update_item' => 'Обновить отдел',
				'add_new_item' => 'Добавить отдел',
				'new_item_name' => 'Название отдел',
				'view_item' => 'Перейти к отделу',
				'search_items' => 'Искать отдел',
				'not_found' =>  'Не найдено отделов',
			]
		]
	);
        
       
}

?>