<?php get_header(); ?>

<?php
// Создаем WP_Query с нужными аргументами
//$args = array(
//    'post_type' => 'product',
//    'posts_per_page' => 5,
//    'paged' => get_query_var( 'page' ) // Используем 'paged' для текущей страницы
//);

$query = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => 8,
    'paged' => get_query_var('page') ?: 1
]);

//$query = new WP_Query( $args );



if ( $query->have_posts() ) : ?>
    <div class="container">
        <h1 class="archive-title"><?php the_archive_title();        ?></h1>
        <div class="row">

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <div class="col-md-3 mb-4">
                    <article <?php post_class(); ?>>
                        <small><?php the_time('F jS, Y') ?> Автор: <?php the_author_posts_link() ?></small>

                        <div>
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>

                        <div>
                            <p> Price: <?php the_field('price'); ?></p>
                            <p> Count: <?php the_field('count'); ?></p>
                        </div>

                        <div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Купить</a>
                        </div>
                    </article>
                </div>

            <?php endwhile;
            $GLOBALS['wp_query'] = $query;?>


            <?php the_posts_pagination(
                [
                    'format' => '?page=%#%',
                    'prev_text' => 'Previous page',
                    'next_text' => 'Next page',
                    'before_page_number' => '<span class="meta-nav screen-reader-text">Page</span>'
                ]);
            ?>

        </div>
    </div>
<?php else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>





<?php
//
//get_header(); ?>
<!---->
<!--<div id="container w-100  ">-->
<!--    <div class="row w-100">-->
<!--        <div class="col-10">-->
<!---->
<!--            --><?php
//
//            $query = new WP_Query([
//                'post_type' => 'product',
//                'posts_per_page' => 8,
//                'paged' => get_query_var('page') ?: 1
//            ]);
//
//            if ($query->have_posts()) : ?>
<!--                <div class="row w-100">-->
<!--                    --><?php //while ($query->have_posts()) : $query->the_post() ?>
<!--                        --><?php //?>
<!--                        <div class="card col-3">-->
<!--                            --><?php //the_post_thumbnail('thumbnail', ['class' => 'card-image']); ?>
<!--                            <div class="card-body">-->
<!--                                <h5 class="card-title">--><?php //echo get_the_title() ?><!--</h5>-->
<!--                                <p class="card-text">--><?php //the_excerpt() ?><!--</p>-->
<!--                                <p class="">--><?php //echo get_field('price') ?><!--</p>-->
<!--                                <div>-->
<!--                                    <a href="--><?php //echo get_the_permalink() ?><!--" class="btn btn-primary">Купить</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    --><?php //endwhile;
//
//                    $GLOBALS['wp_query'] = $query;
//                    ?>
<!--                    <div class="row w-100">-->
<!--                        --><?php //the_posts_pagination(
//                            [
//                                'format' => '?page=%#%',
//                                'prev_text' => 'Previous page',
//                                'next_text' => 'Next page',
//                                'before_page_number' => '<span class="meta-nav screen-reader-text">Page</span>'
//                            ]);
//                        ?>
<!--                    </div>-->
<!--                    --><?php
//                    wp_reset_postdata(); ?>
<!--                </div>-->
<!---->
<!--            --><?php //else :
//                echo '<p>No posts found in this category.</p>';
//            endif;
//
//
//            ?>
<!--        </div>-->
<!--        <div class="col-2">-->
<!--            --><?php //dynamic_sidebar('rating-sidebar'); ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->
<?php //get_footer(); ?>
