<?php
//////
//get_header(); ?>
<!---->
<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!---->
<!--            <h1>--><?php //the_title(); ?><!--</h1>-->
<!---->
<!--            <div class="product-info">-->
<!---->
<!--                <div class="product-image">-->
<!--                    --><?php //the_post_thumbnail('thumbnail', ['class' => 'card-main-image']); ?>
<!--                </div>-->
<!---->
<!--                <div class="product-details">-->
<!--                    --><?php //the_content(); ?>
<!---->
<!--                    <p>Цена: --><?php //the_field('price'); ?><!--</p>-->
<!--                    <p>Количество: --><?php //the_field('count'); ?><!--</p>-->
<!---->
<!--                    <button class="btn btn-primary">В корзину</button>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--            --><?php //if (comments_open() || get_comments_number()) : ?>
<!--                <h2>Комментарии</h2>-->
<!--                --><?php //comments_template(); ?>
<!--            --><?php //endif; ?>
<!---->
<!--            --><?php //comment_form(); ?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<?php get_header() ?>
    <div class="container w-50">
        <?php while (have_posts()) : the_post() ?>
            <?php ?>
            <div class="card row align-content-center">

                <div class="card-body col-12">
                    <?php the_post_thumbnail('thumbnail', ['class' => 'card-main-image']); ?>

                    <div>
                        <button class="btn btn-primary button-cart-add" data-id="<?php echo get_the_ID() ?>" >В
                            корзину</button>
                    </div>
                </div>
            </div>
            <div class="row">

                <?php comments_template() ?>
<!--                            --><?php //if (comments_open() || get_comments_number()) : ?>
<!--                                <h2>Комментарии</h2>-->
<!--                                --><?php //comments_template(); ?>
<!--                            --><?php //endif; ?>
            </div>

        <?php endwhile; ?>
    </div>

<?php get_footer() ?>