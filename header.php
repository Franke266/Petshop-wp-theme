<!DOCTYPE html>
<html <?php language_attributes();?>>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">

    <title>PET shop</title>
    <?php wp_head(); ?>
  </head>
  <body style="overflow-x: hidden;">
    <?php
    if(!empty($_SESSION["shopping_cart"])) {
        foreach ($_SESSION["shopping_cart"] as $kol) {
            $cart_count+=$kol['kolicina'];
        }
//$cart_count = count(array_keys($_SESSION["shopping_cart"]));
}
else
{
    $cart_count="0";
}
?>


    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a href="http://localhost/petshop/"><img src="<?php bloginfo('template_directory');?>/img/titleimg.png"
         title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
        <h1 class="navbar-brand"><?php bloginfo('name'); ?></h1>
        </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <?php
             wp_nav_menu( array(
             'menu'              => 'primary',
             'theme_location'    => 'header-menu',
             'depth'             => 2,
             'container'         => 'div',
             'container_class'   => '',
             'container_id'      => '',
             'menu_class'        => 'navbar-nav mr-auto',
             'fallback_cb'       => 'Bootstrap_NavWalker::fallback',
             'walker'            => new Bootstrap_NavWalker())
             );
        ?>
        <a href="http://localhost/petshop/kosarica/"><i class="fas fa-shopping-cart"><?php echo $cart_count; ?></i></a>
    </div>
    
</nav>
        
        




