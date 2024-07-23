<?php
get_header(); // Вывод заголовка
?>

<div class="container">
    <div class="row">

        <!-- Проверка наличия записей в цикле -->
        <?php if (have_posts()) : ?>

            <!-- Начало цикла -->
            <?php while (have_posts()) : the_post(); ?>
                <!-- Цикл WordPress -->
                <!-- Здесь уже определилась переменная $post, -->
                <!-- на основе которой будет строится дальнейший код. -->
                <!-- $post будет меняться для каждого поста while( have_posts() ). -->
                <!-- $post нужна, чтобы работали теги шаблона: in_category('3'), the_permalink() и т.д. -->

                <!-- Проверка находится ли этот пост в категории 3. -->
                <!-- Если да, то задаем CSS класс div-у class="post-cat-three". -->
                <!-- Если нет, то класс будет post class="post". -->
                <div class="post">
                    <div>
                        <?php if (the_title()) : ?>
                            <?php the_title(); ?>
                        <?php endif; ?>
                        <br>
                        <small><?php the_time('F jS, Y') ?> Автор: <?php the_author_posts_link() ?></small>

                    </div>


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

                    <!---->
                    <!---->
                </div> <!-- закрываем основной тег div -->


            <?php endwhile; ?>
        <?php endif; ?>

    </div>
</div>

<?php
get_footer(); // Вывод подвала
?>
