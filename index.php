<?php get_header(); ?>

    <main role="main">
		<?php
		if ( is_front_page() ) {
                echo '<span>frontpage</span>';

		} else { ?>

            <section id="primary" class="content-area">
                <div id="content" class="site-content" role="main">

					<?php if ( have_posts() ) : ?>


						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'search' ); ?>

						<?php endwhile; ?>

                        result

					<?php else : ?>

                        <div class="col-md-8 col-md-offset-2 text-center">

                            <h1><br>Página no encontrada</h1>
                            <p class="lead margin-40">La dirección web no está bien escrita o fue dada de baja.<br>Te invitamos a usar el buscador o explorar el sitio web.</p>
                            <p class="margin-60"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Ir la página de inicio</a></p>

                        </div>


						<?php get_template_part( 'no-results', 'search' ); ?>

					<?php endif; ?>

                </div><!-- #content .site-content -->
            </section><!-- #primary .content-area -->

		<?php }?>
    </main>

<?php get_footer(); ?>