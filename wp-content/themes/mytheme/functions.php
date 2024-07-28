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
    register_post_type('product', [
        'label' => null,
        'labels' => [
            'name' => 'Products', // основное название для типа записи
            'singular_name' => 'Product', // название для одной записи этого типа
            'add_new' => 'Add product', // для добавления новой записи
            'add_new_item' => 'Add product', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Add product', // для редактирования типа записи
            'new_item' => 'New product', // текст новой записи
            'view_item' => 'View product', // для просмотра записи этого типа.
            'search_items' => 'Search product', // для поиска по этим типам записи
            'not_found' => 'Not found', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Not found in trash', // если не было найдено в корзине
            'parent_item_colon' => '', // для родителей (у древовидных типов)
            'menu_name' => 'Product', // название меню
        ],
        'description' => 'product description',
        'public' => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu' => true, // показывать ли в меню админки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest' => null, // добавить в REST API. C WP 4.7
        'rest_base' => null, // $post_type. C WP 4.7
        'menu_position' => null,
        'menu_icon' => null,
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail', 'comments'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies' => [],
        'has_archive' => true,
        'query_var' => true,
    ]);
}
add_action( 'init', 'create_product_post_type' );


add_theme_support( 'post-thumbnails');




function my_theme_enqueue_scripts() {
    wp_enqueue_script( 'cart-js', get_template_directory_uri() . '/cart.js', array( 'jquery' ), '1.0', true ); // true  -  загружает скрипт в  footer

    // Передача переменной на клиентскую сторону id страницы
    wp_localize_script( 'cart-js', 'cartScriptData', array(
        'currentPageID' => get_the_ID(), // ID текущей страницы
    ) );
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts' );


//возвращает всю инфу а не по конкретному товару
function get_products_callback() {


    // Получаем аргументы запроса
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1, //  Получить все товары
    );

    // Получаем список товаров
    $products = get_posts($args);

    // Формируем ответ в формате JSON
    $response = array();
    foreach ($products as $product) {
        $response[] = array(
            'id' => $product->ID,
            'name' => $product->post_title,
            'price' => get_post_meta($product->ID, '_price', true),
            'image_url' => get_the_post_thumbnail_url($product->ID, 'full'), //  Получение URL изображения
            'description' => $product->post_content,
            // ... другие данные о товаре, которые вы хотите вернуть
        );
    }

    wp_send_json($response);
}

//тут в $_POST['cartItems'] почему-то null
//function get_products_callback() {
//    $cart_items = $_POST['cartItems']; //  Получаем данные о корзине
//
//    //  Обработка данных (получение информации о товарах из WooCommerce или другой системы)
//    $response = [];
//    foreach ($cart_items as $product_id => $quantity) {
//        //  Получаем информацию о товаре (замените эту часть своей логикой)
//        $product = get_post($product_id);
//        if ($product) {
//            $response[] = [
//                'id' => $product->ID,
//                'name' => $product->post_title,
//                'price' => get_post_meta($product->ID, '_price', true),
//                'image_url' => get_the_post_thumbnail_url($product->ID, 'full'),
//                'description' => $product->post_content,
//                'quantity' => $quantity //  Добавляем количество
//            ];
//        }
//    }
//
//    //  Возвращаем ответ в формате JSON
//    wp_send_json($response);
//}


// Регистрируем маршрут API
add_action( 'rest_api_init', function () {
    register_rest_route( '/api', '/get-cart-items', array(
        'methods'  => 'POST',
        'callback' => 'get_products_callback',
    ));
});
