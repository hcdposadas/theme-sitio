<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php bloginfo( 'title' ); ?></title>


    <!-- Nav and address bar color -->
    <meta name="theme-color" content="<?php echo get_theme_mod('primary_color');?>">
    <meta name="msapplication-navbutton-color" content="<?php echo get_theme_mod('primary_color');?>">
    <meta name="apple-mobile-web-app-status-bar-style" content="<?php echo get_theme_mod('primary_color');?>">

	<?php wp_head(); ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120931985-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-120931985-1');

        gtag('set', 'userId', <?php echo get_current_user_id(); ?>);

    </script>

</head>

<body cz-shortcut-listen="true">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v6.0&appId=2042806675935577&autoLogAppEvents=1"></script>
<header>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if ( has_custom_logo( 0 ) ) {
						echo get_custom_logo( 0 );
					} else {
						?>
                        <img alt="Brand" src="<?php echo get_stylesheet_directory_uri(); ?>/images/argentinagob.svg"
                             height="50">
					<?php } ?>
                    <h1 class="sr-only"><?php bloginfo( 'name' ); ?>
                        <small><?php bloginfo( 'description' ); ?></small>
                    </h1>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
					<?php

//					$itemsMenu = wp_get_nav_menu_items( 'Principal' );
//
//					foreach ( $itemsMenu as $item ) {
//						$cssClass = '';
//						foreach ( $item->classes as $class ) {
//							$cssClass .= " " . $class;
//						}
//						echo '<li><a class="' . $cssClass . '" href="' . $item->url . '" title="">' . $item->title . '</a></li>';
//					}

					// wordpress does not group child menu items with parent menu items
					$navbar_items = wp_get_nav_menu_items( "Principal" );
					$child_items  = [];

					// pull all child menu items into separate object
					foreach ( $navbar_items as $key => $item ) {
						if ( $item->menu_item_parent ) {
							array_push( $child_items, $item );
							unset( $navbar_items[ $key ] );
						}
					}
					// push child items into their parent item in the original object
					foreach ( $navbar_items as $item ) {
						foreach ( $child_items as $key => $child ) {
							if ( $child->menu_item_parent == $item->ID ) {
								if ( ! $item->child_items ) {
									$item->child_items = [];
								}
								array_push( $item->child_items, $child );
								unset( $child_items[ $key ] );
							} else {
								foreach ( $child_items as $ki => $ci ) {
									if ( $ci->menu_item_parent == $child->ID ) {
										if ( ! $child->child_items ) {
											$child->child_items = [];
										}
										array_push( $child->child_items, $ci );
										unset( $child_items[ $ki ] );
									}
								}
							}

						}
					}
					// return navbar object where child items are grouped with parents


					foreach ( $navbar_items as $item ) {

						if ( $item->child_items ) {
							print '<li>';
							print '<a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> ' . $item->title;
							print '<span class="caret"></span>';
							print '</a>';
							echo '<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">';
							foreach ( $item->child_items as $child_item ) {

								if ( $child_item->child_items ) {
									print '<li class="dropdown-submenu">';
									print '<a class="dropdown-toggle test" type="button" id="dropdownMenu' . $child_item->ID . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> ' . $child_item->title;

									print '</a>';
									echo '<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu' . $child_item->ID . '">';
									foreach ( $child_item->child_items as $ci ) {


										$cssClass = '';
										foreach ( $ci->classes as $class ) {
											$cssClass .= " " . $class;
										}
										echo '<li><a class="' . $cssClass . '" href="' . $ci->url . '" title="">' . $ci->title . '</a></li>';


									}
									print '</ul>';
									print '</li>';
								} else {


									$cssClass = '';
									foreach ( $child_item->classes as $class ) {
										$cssClass .= " " . $class;
									}
									echo '<li><a class="' . $cssClass . '" href="' . $child_item->url . '" title="">' . $child_item->title . '</a></li>';
								}


							}
							print '</ul>';
							print '</li>';
						} else {

							$cssClass = '';
							foreach ( $item->classes as $class ) {
								$cssClass .= " " . $class;
							}
							echo '<li><a class="' . $cssClass . '" href="' . $item->url . '" title="">' . $item->title . '</a></li>';
						}


					}


					?>
                    <li>
                        <a title="buscar" href="#modalSearch" role="button" data-toggle="modal"><i
                                    class="fa fa-search"></i></a>
                    </li>
                    <li>
	                    <?php $poncho_ver_sesion_en_vivo = get_theme_mod( 'poncho_ver_sesion_en_vivo' ); ?>
                        <a title="VER SESIÓN EN VIVO" data-toggle="tooltip" href="<?php echo $poncho_ver_sesion_en_vivo; ?>"><i
                                    class="fa fa-video-camera"></i></a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div id="modalSearch" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Buscar</h4>
                </div>
                <div class="modal-body">

	                <?php echo get_search_form();?>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

</header>
