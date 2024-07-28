<?php get_header() ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <h2><?php the_title(); ?></h2>
                    <small><?php the_time('F jS, Y') ?> Автор: <?php the_author_posts_link() ?></small>

                    <div>
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>

                    <div>
                        <p> Price: <?php the_field('price'); ?></p>
                        <p> Count: <?php the_field('count'); ?></p>
                    </div>
                    <div>
                        <button
                                class="btn btn-primary" data-id="<?php echo get_the_ID() ?>" id="add-product" data-product-count="1">В корзину
                        </button>
                        <button
                                class="btn btn-primary" data-id="<?php echo get_the_ID() ?>" id="delete-product" data-product-count="-1">Из корзины
                        </button>

                        <button
                                class="btn btn-primary" data-id="<?php echo get_the_ID() ?>" data-product-count="-1" onclick=console.log(getCartTotalQuantity());>в корзине
                        </button>

                        <button
                                class="btn btn-primary" data-id="<?php echo get_the_ID() ?>" id="delete-cart" data-product-count="-1" onclick="deleteCartCookie()">Удалить все куки корзины
                        </button>

                        <h4>Id товара</h4>
                        <?php echo get_the_ID() ?>
                    <br>
                    <br>
                    <div class="row">

                        <?php comments_template() ?>
                        <!--            --><?php //if (comments_open() || get_comments_number()) : ?>
                        <!--                <h2>Комментарии</h2>-->
                        <!--                --><?php //comments_template(); ?>
                        <!--            --><?php //endif; ?>

                    </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>

<?php get_footer() ?>