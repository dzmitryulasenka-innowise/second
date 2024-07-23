<?php get_header(); ?>

    <div class="container">
        <h1 class="archive-title"><?php the_archive_title(); ?></h1>
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <!-- Выводим дату поста и ссылку на другие записи автора. -->
                    <small><?php the_time('F jS, Y') ?> Автор: <?php the_author_posts_link() ?></small>

                    <!-- Выводим текст поста в теге div. -->
                    <div class="entry">
                        <?php the_content(); ?>
                    </div>

                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>