<?php get_header(); ?>
    <div class="container">
        <section>
            <article class="content_format row">
                <div class="col-md-8 col-md-offset-2">

                    <h1><?php the_title(); ?></h1>
                    <hr>
                    <div class="col-md-12">
						<?php
						while ( have_posts() ) :
							the_post();

							the_content();

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>
                    </div>

            </article>
        </section>

		<?php if ( is_page( 'autoridades' ) ): ?>
            <section>
                <div class="container">
                    <div class="row ">
                        <div class="col-md-12">
                            <h2 class="h3 section-title">Conocé a Nuestros Concejales</h2>
                        </div>
                    </div>
					<?php get_template_part( 'template-parts/content', 'slide-concejales' ); ?>
                </div>
            </section>
            <section>
                <div class="container">
                    <div class="row text-center">
                        <div class="col-xs-12">
                            <a class="btn btn-primary" href="https://hcdposadas.gob.ar/areas">Conocer todas las áreas</a>
                        </div>
                    </div>
                </div>
            </section>
		<?php endif; ?>
    </div>
<?php get_footer(); ?>