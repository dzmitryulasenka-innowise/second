<?php get_header(); ?>

    <div class="container">
        <h1 class="archive-title"><?php the_archive_title(); ?></h1>
        <?php if ( have_posts() ) : ?>

            <div class="container">
                <div class="row">

                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Товар 1">
                            <div class="card-body">
                                <h5 class="card-title">Товар 1</h5>
                                <p class="card-text">Описание товара 1.</p>
                                <a href="#" class="btn btn-primary">Подробнее</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>





            <?php while ( have_posts() ) : the_post(); ?>

                <article <?php post_class(); ?>>
                    <!-- Выводим дату поста и ссылку на другие записи автора. -->
                    <small><?php the_time('F jS, Y') ?> Автор: <?php the_author_posts_link() ?></small>

                    <div>
                        <!--                        --><?php //if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('thumbnail'); ?>
                        <!--                        --><?php //endif; ?>
                    </div>

                    <div>
                        <!--                        --><?php //if (the_field('price')) : ?>
                        <p> Price: <?php the_field('price'); ?></p>
                        <!--                        --><?php //endif; ?>

                        <!--                        --><?php //if (the_field('count')) : ?>
                        <p> Count: <?php the_field('count'); ?></p>
                        <!--                        --><?php //endif; ?>
                    </div>

                    <div>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Купить</a>
                    </div>

                </article>

            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>