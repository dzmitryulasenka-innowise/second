<?php

/**
 * Регистрация меню
 */
function register_my_menus() {
    register_nav_menus( array(
        'primary' => __( 'Главное меню мое меню', 'mytheme' ),
    ) );
}
add_action( 'after_setup_theme', 'register_my_menus' );
//Присоединяет функцию register_my_menus() к событию after_setup_theme, чтобы она выполнилась после инициализации темы.

/**
 * Подключение стилей из моего файла и из бутстрапа
 */
function enqueue_styles() {
    wp_enqueue_style( 'my-theme-styles', get_stylesheet_uri() );
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
}

//add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
//Присоединяет функцию enqueue_styles1() к событию wp_enqueue_scripts, чтобы она выполнилась при загрузке страницы.
add_action( 'after_setup_theme', 'enqueue_styles' );


//Подключение моих и скриптов Bootstrap если нужны - добавить папку и файлы
function enqueue_scripts() {
//    wp_enqueue_script( 'my-theme-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array( 'jquery' ), '4.5.2', true );
}
//add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
add_action( 'after_setup_theme', 'enqueue_scripts' );


/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );








function create_product_post_type() {
    register_post_type( 'product',
        array(
            'labels' => array(
                'name' => __( 'Products', 'textdomain' ),
                'singular_name' => __( 'Product', 'textdomain' ),
                'add_new' => __( 'Add new', 'textdomain' ),
                'add_new_item' => __( 'Add new product', 'textdomain' ),
                'edit_item' => __( 'Edit product', 'textdomain' ),
                'new_item' => __( 'New product', 'textdomain' ),
                'view_item' => __( 'View product', 'textdomain' ),
                'search_items' => __( 'Search product', 'textdomain' ),
                'not_found' => __( 'Products not found', 'textdomain' ),
                'not_found_in_trash' => __( 'Products not found in trash', 'textdomain' ),
                'parent_item_colon' => __( 'Parent item:', 'textdomain' ),
                'menu_name' => __( 'Products', 'textdomain' ),
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_nav_menus' => true,
        )
    );
}
add_action( 'init', 'create_product_post_type' );


add_theme_support( 'post-thumbnails');
