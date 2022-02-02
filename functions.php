<?php
	session_start();
	
	//Brisanje pojedinog artikla iz košarice
	if (isset($_POST['action']) && $_POST['action']=="remove"){
		if(!empty($_SESSION["shopping_cart"])) {
    		foreach($_SESSION["shopping_cart"] as $key => $value) {
      			if($_POST["artikl_id"] == $_SESSION["shopping_cart"][$key]['artikl_id']){
      				$trenutnakolicinahrana = get_post_meta($_POST["artikl_id"], 'kolicina_hrane', true);
      				$trenutnakolicinahigijena = get_post_meta($_POST["artikl_id"], 'kolicina_higijene', true);
      				$trenutnakolicinaoprema = get_post_meta($_POST["artikl_id"], 'kolicina_opreme', true);
      				$trenutnakolicinaigracka = get_post_meta($_POST["artikl_id"], 'kolicina_igracke', true);
      				$novavrijednosthrane=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinahrana;
      				$novavrijednosthigijene=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinahigijena;
      				$novavrijednostopreme=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinaoprema;
      				$novavrijednostigracke=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinaigracka;
      				update_post_meta( $_POST['artikl_id'], 'kolicina_hrane', $novavrijednosthrane );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_higijene', $novavrijednosthigijene );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_opreme', $novavrijednostopreme );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_igracke', $novavrijednostigracke );
      				unset($_SESSION["shopping_cart"][$key]);
      			}
      			if(empty($_SESSION["shopping_cart"]))
      				unset($_SESSION["shopping_cart"]);
      			} 
		}
	}

	//Brisanje cijele košarice
	if (isset($_POST['action']) && $_POST['action']=="empty"){
		if(!empty($_SESSION["shopping_cart"])) {
    		foreach($_SESSION["shopping_cart"] as $brisanje) {
      			$trenutnakolicinahrana = get_post_meta($brisanje['artikl_id'], 'kolicina_hrane', true);
      			$trenutnakolicinahigijena = get_post_meta($brisanje['artikl_id'], 'kolicina_higijene', true);
      			$trenutnakolicinaoprema = get_post_meta($brisanje['artikl_id'], 'kolicina_opreme', true);
      			$trenutnakolicinaigracka = get_post_meta($brisanje['artikl_id'], 'kolicina_igracke', true);
      			$novavrijednosthrane=$brisanje['kolicina']+$trenutnakolicinahrana;
      			$novavrijednosthigijene=$brisanje['kolicina']+$trenutnakolicinahigijena;
      			$novavrijednostopreme=$brisanje['kolicina']+$trenutnakolicinaoprema;
      			$novavrijednostigracke=$brisanje['kolicina']+$trenutnakolicinaigracka;
      			update_post_meta( $brisanje['artikl_id'], 'kolicina_hrane', $novavrijednosthrane );
      			update_post_meta( $brisanje['artikl_id'], 'kolicina_higijene', $novavrijednosthigijene );
      			update_post_meta( $brisanje['artikl_id'], 'kolicina_opreme', $novavrijednostopreme );
      			update_post_meta( $brisanje['artikl_id'], 'kolicina_igracke', $novavrijednostigracke );
      			unset($_SESSION["shopping_cart"]);
  			}
		}
	}

	//Potvrda narudžbe
  	if (isset($_POST['action']) && $_POST['action']=="potvrda"){
  		echo ("<script>
    	window.location.href='http://localhost/petshop/narudzba-izvrsena/';
    	</script>");
      	unset($_SESSION["shopping_cart"]);
  	}

  	//Ažuriranje pojedinog artikla iz košarice
	if (isset($_POST['action']) && $_POST['action']=="change"){
		if($_POST["nova_kol"]<0)
    	{
    		echo ("<script>
    		alert('Neuspješno ažuriranje košarice, unesite valjanu vrijednost!');
    		</script>");
    	}
    	else if($_POST["nova_kol"]==0)
    	{
    		foreach($_SESSION["shopping_cart"] as $key => $value){
    			if($_SESSION["shopping_cart"][$key]['artikl_id'] === $_POST["artikl_id"]){
    				$trenutnakolicinahrana = get_post_meta($_POST["artikl_id"], 'kolicina_hrane', true);
      				$trenutnakolicinahigijena = get_post_meta($_POST["artikl_id"], 'kolicina_higijene', true);
      				$trenutnakolicinaoprema = get_post_meta($_POST["artikl_id"], 'kolicina_opreme', true);
      				$trenutnakolicinaigracka = get_post_meta($_POST["artikl_id"], 'kolicina_igracke', true);
      				$novavrijednosthrane=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinahrana;
      				$novavrijednosthigijene=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinahigijena;
      				$novavrijednostopreme=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinaoprema;
      				$novavrijednostigracke=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinaigracka;
      				update_post_meta( $_POST['artikl_id'], 'kolicina_hrane', $novavrijednosthrane );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_higijene', $novavrijednosthigijene );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_opreme', $novavrijednostopreme );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_igracke', $novavrijednostigracke );
    				unset($_SESSION["shopping_cart"][$key]);
    				if(empty($_SESSION["shopping_cart"])){
      					unset($_SESSION["shopping_cart"]);
    				} 
    			}
    		}
		}
      	else{
      		foreach($_SESSION["shopping_cart"] as $key => $value){
    			if($_SESSION["shopping_cart"][$key]['artikl_id'] === $_POST["artikl_id"]){
    				$trenutnakolicinahrana = get_post_meta($_POST["artikl_id"], 'kolicina_hrane', true);
      				$trenutnakolicinahigijena = get_post_meta($_POST["artikl_id"], 'kolicina_higijene', true);
      				$trenutnakolicinaoprema = get_post_meta($_POST["artikl_id"], 'kolicina_opreme', true);
      				$trenutnakolicinaigracka = get_post_meta($_POST["artikl_id"], 'kolicina_igracke', true);
      				$novavrijednosthrane=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinahrana;
      				$novavrijednosthigijene=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinahigijena;
      				$novavrijednostopreme=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinaoprema;
      				$novavrijednostigracke=$_SESSION["shopping_cart"][$key]['kolicina']+$trenutnakolicinaigracka;
      			if($_POST["nova_kol"]>$trenutnakolicinahigijena || $_POST["nova_kol"]>$trenutnakolicinahrana || $_POST["nova_kol"]>$trenutnakolicinaoprema || $_POST["nova_kol"]>$trenutnakolicinaigracka)
      			{
      				echo ("<script>
    				alert('Neuspješno ažuriranje košarice, odabrana količina nije dostupna!');
    				</script>");
      			}
      			else{
      				update_post_meta( $_POST['artikl_id'], 'kolicina_hrane', $novavrijednosthrane );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_higijene', $novavrijednosthigijene );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_opreme', $novavrijednostopreme );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_igracke', $novavrijednostigracke );
      				$_SESSION["shopping_cart"][$key]['kolicina'] = $_POST["nova_kol"];
      				$_SESSION["shopping_cart"][$key]['ukupnac'] = $_SESSION["shopping_cart"][$key]['kolicina']*$_SESSION["shopping_cart"][$key]['cijena'];	
      				$trenutnakolicinahrana2 = get_post_meta($_POST["artikl_id"], 'kolicina_hrane', true);
      				$trenutnakolicinahigijena2 = get_post_meta($_POST["artikl_id"], 'kolicina_higijene', true);
      				$trenutnakolicinaoprema2 = get_post_meta($_POST["artikl_id"], 'kolicina_opreme', true);
      				$trenutnakolicinaigracka2 = get_post_meta($_POST["artikl_id"], 'kolicina_igracke', true);
      				$novavrijednosthrane2=$trenutnakolicinahrana2-$_SESSION["shopping_cart"][$key]['kolicina'];
      				$novavrijednosthigijene2=$trenutnakolicinahigijena2-$_SESSION["shopping_cart"][$key]['kolicina'];
      				$novavrijednostopreme2=$trenutnakolicinaoprema2-$_SESSION["shopping_cart"][$key]['kolicina'];
      				$novavrijednostigracke2=$trenutnakolicinaigracka2-$_SESSION["shopping_cart"][$key]['kolicina'];
      				update_post_meta( $_POST['artikl_id'], 'kolicina_hrane', $novavrijednosthrane2 );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_higijene', $novavrijednosthigijene2 );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_opreme', $novavrijednostopreme2 );
      				update_post_meta( $_POST['artikl_id'], 'kolicina_igracke', $novavrijednostigracke2 );		
  				}
      			break;
      			}
        
    		}
		}
	}
  
//Registracija navbar-a
require get_template_directory() . '/bootstrap-navwalker.php';
if ( ! function_exists( 'inicijaliziraj_temu' ) )
{
	function inicijaliziraj_temu()
	{
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'glavni-menu' => "Glavni navigacijski izbornik"
		) );
		add_theme_support( 'custom-background', apply_filters(
			'test_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
}
add_action( 'after_setup_theme', 'inicijaliziraj_temu' );

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );


//Admin-ajax
add_action('wp_head','my_ajaxurl');
function my_ajaxurl() {
$html = '<script type="text/javascript">';
$html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
$html .= '</script>';
echo $html;
}

//Dodavanje u košaricu
function custom_update_post() {
    $post_id = $_POST['post_id'];
    $item_name = $_POST['naziv_artikla'];
    $item_picture = $_POST['slika_artikla'];
    $new_meta_value = $_POST['nova_kolicina'];
    $item_quantity = $_POST['odabrana_kolicina'];
    $item_price = $_POST['cijena_artikla'];
    $item_price_total = $_POST['ukupna_cijena'];
    $kosarica = array (
			$post_id=> array (
				'artikl_id'=>$post_id,
				'naziv_artikla'=>$item_name,
				'slika_artikla'=>$item_picture,
				'kolicina'=>$item_quantity,
				'cijena'=>$item_price,
				'ukupnac'=>$item_price_total
			)
		);

	if(empty($_SESSION["shopping_cart"])) {
    	$_SESSION["shopping_cart"] = $kosarica;
	}else{
    	$array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($post_id,$array_keys)) {
    	foreach($_SESSION["shopping_cart"] as $k => $v) {
						if($post_id == $k) {
							$_SESSION["shopping_cart"][$k]["kolicina"] = $_SESSION["shopping_cart"][$k]["kolicina"]+$_POST["odabrana_kolicina"];
							$_SESSION["shopping_cart"][$k]["ukupnac"] = ($_SESSION["shopping_cart"][$k]["kolicina"]*$_POST["cijena_artikla"]);
						}
				}
	}else {
    	$_SESSION["shopping_cart"] = array_merge(
    	$_SESSION["shopping_cart"],
    	$kosarica
    	);
 	}
}
 	
    update_post_meta( $post_id, 'kolicina_hrane', $new_meta_value );
    update_post_meta( $post_id, 'kolicina_igracke', $new_meta_value );
    update_post_meta( $post_id, 'kolicina_opreme', $new_meta_value );
    update_post_meta( $post_id, 'kolicina_higijene', $new_meta_value );

    wp_die();
}

add_action( 'wp_ajax_custom_update_post', 'custom_update_post' );


//registracija sidebar-a
function aktiviraj_sidebar()
{
	 register_sidebar(
		array (
			'name' => "Footer sidebar 1",
			'id' => 'footer-sidebar1',
			'description' => "Footer sidebar 1",
			'before_widget' => '<div class="footer-sidebar">',
			'after_widget' => "</div>",
			'before_title' => '<h5 class="footer-sidebar-title">',
			'after_title' => '</h5>',
		)
	);

	register_sidebar(
		array (
			'name' => "Footer sidebar 2",
			'id' => 'footer-sidebar2',
			'description' => "Footer sidebar 2",
			'before_widget' => '<div class="footer-sidebar">',
			'after_widget' => "</div>",
			'before_title' => '<h5 class="footer-sidebar-title">',
			'after_title' => '</h5>',
		)
	);

	register_sidebar(
		array (
			'name' => "Footer sidebar 3",
			'id' => 'footer-sidebar3',
			'description' => "Footer sidebar 3",
			'before_widget' => '<div class="footer-sidebar">',
			'after_widget' => "</div>",
			'before_title' => '<h5 class="footer-sidebar-title">',
			'after_title' => '</h5>',
		)
	);

	register_sidebar(
		array (
			'name' => "Footer sidebar 4",
			'id' => 'footer-sidebar4',
			'description' => "Footer sidebar 4",
			'before_widget' => '<div class="footer-sidebar">',
			'after_widget' => "</div>",
			'before_title' => '<h5 class="footer-sidebar-title">',
			'after_title' => '</h5>',
		)
	);
}
add_action( 'widgets_init', 'aktiviraj_sidebar' );

//učitavanje admin datoteka
/*function UcitajAdminDatoteke()
{
	wp_enqueue_script('jquery-js', get_template_directory_uri().'/vendor/jquery/jquery.min.js', array('jquery'), true);
	wp_enqueue_script('glavni-js', get_template_directory_uri().'/js/skripta.js', array('jquery'), true);
}
add_action( 'admin_enqueue_scripts', 'UcitajAdminDatoteke' );*/

//učitavanje CSS datoteka
function ucitaj_css_datoteke()
{
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/vendor/fontawesome-free/css/all.min.css');
	wp_enqueue_style( 'googlefonts1-css', 'https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' );
	wp_enqueue_style( 'fontawesome2-css', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' );
	wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/css/clean-blog.min.css' );
	wp_enqueue_style( 'main-css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'ucitaj_css_datoteke' );

//učitavanje javascript datoteka
function ucitaj_js_datoteke() 
{
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/vendor/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), true);
	wp_enqueue_script('theme-js', get_template_directory_uri().'/js/clean-blog.min.js', array('jquery'), true);
	wp_enqueue_script('jquery-js', get_template_directory_uri().'/vendor/jquery/jquery.min.js', array('jquery'), true);
	wp_enqueue_script('script-js', get_template_directory_uri().'/js/skripta.js');
}
add_action( 'wp_enqueue_scripts', 'ucitaj_js_datoteke', 1);


//Registracija Custom Post Type-ova
//Higijena CPT
function registriraj_higijena_cpt() {

	$labels = array(
		'name'                  => _x( 'Higijena i njega', 'Post Type General Name', 'pet' ),
		'singular_name'         => _x( 'Higijena i njega', 'Post Type Singular Name', 'pet' ),
		'menu_name'             => __( 'Higijena i njega', 'pet' ),
		'name_admin_bar'        => __( 'Higijena i njega', 'pet' ),
		'archives'              => __( 'Higijena i njega arhiva', 'pet' ),
		'attributes'            => __( 'Atributi', 'pet' ),
		'parent_item_colon'     => __( 'Roditeljski element', 'pet' ),
		'all_items'             => __( 'Sve', 'pet' ),
		'add_new_item'          => __( 'Dodaj novo', 'pet' ),
		'add_new'               => __( 'Dodaj novo', 'pet' ),
		'new_item'              => __( 'Novo', 'pet' ),
		'edit_item'             => __( 'Uredi', 'pet' ),
		'update_item'           => __( 'Ažuriraj', 'pet' ),
		'view_item'             => __( 'Pogledaj', 'pet' ),
		'view_items'            => __( 'Pogledaj sve', 'pet' ),
		'search_items'          => __( 'Pretraži sve', 'pet' ),
		'not_found'             => __( 'Nije pronađen', 'pet' ),
		'not_found_in_trash'    => __( 'Nije pronađen u smeću', 'pet' ),
		'featured_image'        => __( 'Glavna slika', 'pet' ),
		'set_featured_image'    => __( 'Postavi glavnu sliku', 'pet' ),
		'remove_featured_image' => __( 'Ukloni glavnu sliku', 'pet' ),
		'use_featured_image'    => __( 'Postavi glavnu sliku', 'pet' ),
		'insert_into_item'      => __( 'Umetni', 'pet' ),
		'uploaded_to_this_item' => __( 'Preneseno', 'pet' ),
		'items_list'            => __( 'Lista', 'pet' ),
		'items_list_navigation' => __( 'Navigacija', 'pet' ),
		'filter_items_list'     => __( 'Filtriranje', 'pet' ),
	);
	$args = array(
		'label'                 => __( 'Higijena i njega', 'pet' ),
		'description'           => __( 'Higijena i njega post type', 'pet' ),
		'labels'                => $labels,
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon' => 'dashicons-smiley',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => false,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'higijena', $args );

}
add_action( 'init', 'registriraj_higijena_cpt', 0 );

//Taksonomija tip_higijene
function registriraj_taksonomiju_tip_higijene() {
$labels = array(
'name' => _x( 'Tip', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Tip', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Tip', 'pet' ),
'all_items' => __( 'Svi tipovi', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Novi tip', 'pet' ),
'add_new_item' => __( 'Dodaj novi tip', 'pet' ),
'edit_item' => __( 'Uredi tip', 'pet' ),
'update_item' => __( 'Ažuriraj tip', 'pet' ),
'view_item' => __( 'Pogledaj tip', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite tipove sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni tip', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularni tipovi', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema tipa', 'pet' ),
'items_list' => __( 'Lista tipova', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'tip_higijene', array( 'higijena' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_tip_higijene', 0 );

//Taksonomija vrsta_preparata
function registriraj_taksonomiju_vrsta_preparata() {
$labels = array(
'name' => _x( 'Vrsta preparata', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Vrsta preparata', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Vrste preparata', 'pet' ),
'all_items' => __( 'Sve vrste preparata', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Nova vrsta preparata', 'pet' ),
'add_new_item' => __( 'Dodaj novu vrstu preparata', 'pet' ),
'edit_item' => __( 'Uredi vrstu preparata', 'pet' ),
'update_item' => __( 'Ažuriraj vrstu preparata', 'pet' ),
'view_item' => __( 'Pogledaj vrstu preparata', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite vrste sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni vrstu preparata', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularne vrste preparata', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema vrste', 'pet' ),
'items_list' => __( 'Lista vrsta preparata', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'vrsta_preparata', array( 'higijena' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_vrsta_preparata', 0 );

//Ispis svih artikala higijena
function DajHigijenu() {
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'higijena',
		'post_status' => 'publish',
	);
	if( isset( $_POST['zivotinjefilter'] ) )
	{
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'tip_higijene',
				'field' => 'slug',
				'terms' => $_POST['zivotinjefilter']
			)
		);
	}
 
	if( isset( $_POST['preparatifilter'] ) )
	{
		$args['tax_query'][] = array(
			array(
				'taxonomy' => 'vrsta_preparata',
				'field' => 'slug',
				'terms' => $_POST['preparatifilter']
			)
		);
	}
	$higijena = get_posts( $args );
	foreach ($higijena as $a)
	{
		$tax = get_the_terms($a->ID, 'tip_higijene');
		$higijena_cijena = get_post_meta($a->ID, 'cijena_higijene', false);
		$higijena_kolicina = get_post_meta($a->ID, 'kolicina_higijene', false);
		$sIstaknutaSlika="";
		$higijena_naslov=$a->post_title;
		if( get_the_post_thumbnail_url($a->ID) )
		{
			$sIstaknutaSlika = get_the_post_thumbnail_url($a->ID);
		}
		else
		{
			$sIstaknutaSlika = get_template_directory_uri(). '/img/noimage.png';
		}
		if($higijena_naslov!=""){
		$obj=(object)[
			'id_higijene' => $a->ID,
			'naziv_higijene' => $a->post_title,
			'istaknuta_slika' => $sIstaknutaSlika,
			'guid' => $a->guid,
			'cijene' => array(),
			'kolicine' => array()
		];
		if(!empty($tax) && !is_wp_error($tax)){
			if(!empty($higijena_cijena) && !is_wp_error($higijena_cijena)){
				if(!empty($higijena_kolicina) && !is_wp_error($higijena_kolicina)){
			$cijene=array();
			$kolicine=array();
			foreach ($higijena_cijena as $key) {

				$cij=(object)[
					'cijena_higijene' => $key
				];
				array_push($cijene, $cij);
			}
			foreach ($higijena_kolicina as $key) {
				$kol=(object)[
					'kolicina_higijene' => $key
				];
				array_push($kolicine, $kol);
			}
			array_push($obj->cijene, $cijene);
			array_push($obj->kolicine, $kolicine);
		
		echo '<a href="'.$obj->guid.'"><div class="card shadow-sm mb-4">';
	$sHtml = '<div class="card-body d-flex flex-column">';

	foreach ($obj->cijene as $cij) {
		foreach ($cij as $d) {
			$sHtmlCijeneList =$d->cijena_higijene;
		}
	}

	foreach ($obj->kolicine as $kol) {
		foreach ($kol as $c) {
			if($c->kolicina_higijene==0)
			{
				$sHtmlKolicineList='<p class="mt-auto" style="color:red;">'."Nedostupno".'</p>';
			}
			else{
				$sHtmlKolicineList='<p class="mt-auto" style="color:green;">'."Na skladištu".'</p>';
			}
		}
	}
	
  $sHtml .='<img class="card-img-top" src="'.$obj->istaknuta_slika.'" alt="Card image cap">';
    $sHtml .='<h5 class="card-title">'.$obj->naziv_higijene.'</h5>';
    $sHtml .='<p class="card-text mt-auto">Cijena: '.$sHtmlCijeneList.' kn'.$sHtmlKolicineList.'</p>';
 echo $sHtml .'</div>';
 echo '</div></a>';
	}
}
}
}
	
	}
	die();
}

add_action('wp_ajax_filterhigijena', 'DajHigijenu'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_filterhigijena', 'DajHigijenu');

//Hrana CPT
function registriraj_hrana_cpt() {

	$labels = array(
		'name'                  => _x( 'Hrana', 'Post Type General Name', 'pet' ),
		'singular_name'         => _x( 'Hrana', 'Post Type Singular Name', 'pet' ),
		'menu_name'             => __( 'Hrana', 'pet' ),
		'name_admin_bar'        => __( 'Hrana', 'pet' ),
		'archives'              => __( 'Hrana arhiva', 'pet' ),
		'attributes'            => __( 'Atributi', 'pet' ),
		'parent_item_colon'     => __( 'Roditeljski element', 'pet' ),
		'all_items'             => __( 'Sva hrana', 'pet' ),
		'add_new_item'          => __( 'Dodaj novu hranu', 'pet' ),
		'add_new'               => __( 'Dodaj novu', 'pet' ),
		'new_item'              => __( 'Nova hrana', 'pet' ),
		'edit_item'             => __( 'Uredi hranu', 'pet' ),
		'update_item'           => __( 'Ažuriraj hranu', 'pet' ),
		'view_item'             => __( 'Pogledaj hranu', 'pet' ),
		'view_items'            => __( 'Pogledaj hranu', 'pet' ),
		'search_items'          => __( 'Pretraži hranu', 'pet' ),
		'not_found'             => __( 'Nije pronađen', 'pet' ),
		'not_found_in_trash'    => __( 'Nije pronađen u smeću', 'pet' ),
		'featured_image'        => __( 'Glavna slika', 'pet' ),
		'set_featured_image'    => __( 'Postavi glavnu sliku', 'pet' ),
		'remove_featured_image' => __( 'Ukloni glavnu sliku', 'pet' ),
		'use_featured_image'    => __( 'Postavi glavnu sliku', 'pet' ),
		'insert_into_item'      => __( 'Umetni', 'pet' ),
		'uploaded_to_this_item' => __( 'Preneseno', 'pet' ),
		'items_list'            => __( 'Lista', 'pet' ),
		'items_list_navigation' => __( 'Navigacija među hranom', 'pet' ),
		'filter_items_list'     => __( 'Filtriranje hrane', 'pet' ),
	);
	$args = array(
		'label'                 => __( 'Hrana', 'pet' ),
		'description'           => __( 'Hrana post type', 'pet' ),
		'labels'                => $labels,
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon' => 'dashicons-food',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => false,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'hrana', $args );

}
add_action( 'init', 'registriraj_hrana_cpt', 0 );

//Taksonomija tip_hrane
function registriraj_taksonomiju_tip_hrane() {
$labels = array(
'name' => _x( 'Tip hrane', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Tip hrane', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Tip hrane', 'pet' ),
'all_items' => __( 'Svi tipovi hrane', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Novi tip hrane', 'pet' ),
'add_new_item' => __( 'Dodaj novi tip hrane', 'pet' ),
'edit_item' => __( 'Uredi tip hrane', 'pet' ),
'update_item' => __( 'Ažuriraj tip hrane', 'pet' ),
'view_item' => __( 'Pogledaj tip hrane', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite tipove hrane sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni tip hrane', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularni tipovi hrane', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema tipa hrane', 'pet' ),
'items_list' => __( 'Lista tipova hrane', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'tip_hrane', array( 'hrana' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_tip_hrane', 0 );

//Taksonomija gramaza
function registriraj_taksonomiju_gramaza() {
$labels = array(
'name' => _x( 'Gramaža', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Gramaža', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Gramaža', 'pet' ),
'all_items' => __( 'Sve gramaže', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Nova gramaža', 'pet' ),
'add_new_item' => __( 'Dodaj novu gramažu', 'pet' ),
'edit_item' => __( 'Uredi gramažu', 'pet' ),
'update_item' => __( 'Ažuriraj gramažu', 'pet' ),
'view_item' => __( 'Pogledaj gramažu', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite gramaže sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni gramaže', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularne gramaže', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema gramaže', 'pet' ),
'items_list' => __( 'Lista gramaža', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'gramaza', array( 'hrana' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_gramaza', 0 );

//Taksonomija pakiranja
function registriraj_taksonomiju_pakiranja() {
$labels = array(
'name' => _x( 'Pakiranje', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Pakiranje', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Pakiranje', 'pet' ),
'all_items' => __( 'Sva pakiranja', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Novo pakiranje', 'pet' ),
'add_new_item' => __( 'Dodaj novo pakiranje', 'pet' ),
'edit_item' => __( 'Uredi pakiranje', 'pet' ),
'update_item' => __( 'Ažuriraj pakiranje', 'pet' ),
'view_item' => __( 'Pogledaj pakiranje', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite pakiranja sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni pakiranje', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularna pakiranja', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema pakiranja', 'pet' ),
'items_list' => __( 'Lista pakiranja', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'pakiranja', array( 'hrana' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_pakiranja', 0 );

 //Ispis artikala hrana
function DajHranu(){
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'hrana',
		'post_status' => 'publish',
	);
	if( isset( $_POST['zivotinjefilter'] ) )
	{
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'tip_hrane',
				'field' => 'slug',
				'terms' => $_POST['zivotinjefilter']
			)
		);
	}
 
	if( isset( $_POST['pakiranjafilter'] ) )
	{
		$args['tax_query'][] = array(
			array(
				'taxonomy' => 'pakiranja',
				'field' => 'slug',
				'terms' => $_POST['pakiranjafilter']
			)
		);
	}
	$hrana = get_posts( $args );
	foreach ($hrana as $a)
	{
		$tax = get_the_terms($a->ID, 'gramaza');
		$tax2 = get_the_terms($a->ID, 'tip_hrane');
		$hrana_cijena = get_post_meta($a->ID, 'cijena_hrane', false);
		$hrana_kolicina = get_post_meta($a->ID, 'kolicina_hrane', false);
		$hrana_naslov=$a->post_title;
		$sIstaknutaSlika="";
		if( get_the_post_thumbnail_url($a->ID) )
		{
			$sIstaknutaSlika = get_the_post_thumbnail_url($a->ID);
		}
		else
		{
			$sIstaknutaSlika = get_template_directory_uri(). '/img/noimage.png';
		}
		if($hrana_naslov!=""){
		$obj=(object)[
			'id_hrane' => $a->ID,
			'naziv_hrane' => $a->post_title,
			'istaknuta_slika' => $sIstaknutaSlika,
			'guid' => $a->guid,
			'gramaze' => array(),
			'cijene' => array(),
			'kolicine'=> array()
		];
		if(!empty($tax2) && !is_wp_error($tax2)){
			if(!empty($tax) && !is_wp_error($tax)){
			if(!empty($hrana_cijena) && !is_wp_error($hrana_cijena)){
				if(!empty($hrana_kolicina) && !is_wp_error($hrana_kolicina)){
			$gramaze=array();
			$cijene=array();
			$kolicine=array();
			foreach ($tax as $term) {

				$gra=(object)[
					'gramaza_naziv' => $term->name,
					'gramaza_slug' => $term->slug
				];
				array_push($gramaze, $gra);
			}
			foreach ($hrana_cijena as $key) {
				$cij=(object)[
					'cijena_hrane' => $key
				];
				array_push($cijene, $cij);
			}
			foreach ($hrana_kolicina as $key) {
				$kol=(object)[
					'kolicina_hrane' => $key
				];
				array_push($kolicine, $kol);
			}
			array_push($obj->gramaze, $gramaze);
			array_push($obj->cijene, $cijene);
			array_push($obj->kolicine, $kolicine);
		
		echo '<a href="'.$obj->guid.'"><div class="card shadow-sm mb-4">';
	$sHtml = '<div class="card-body d-flex flex-column">';
	foreach ($obj->gramaze as $gra) {
		foreach ($gra as $b) {
			$sHtmlGramazeList ='<h6>'.$b->gramaza_naziv.'</h6>';
		}
	}

	foreach ($obj->cijene as $cij) {
		foreach ($cij as $d) {

			$sHtmlCijeneList =$d->cijena_hrane;
		}
	}

	foreach ($obj->kolicine as $kol) {
		foreach ($kol as $c) {
			if($c->kolicina_hrane==0)
			{
				$sHtmlKolicineList='<p class="mt-auto" style="color:red;">'."Nedostupno".'</p>';
			}
			else{
				$sHtmlKolicineList='<p class="mt-auto" style="color:green;">'."Na skladištu".'</p>';
			}
		}
	}
	
  $sHtml .='<img class="card-img-top" src="'.$obj->istaknuta_slika.'" alt="Card image cap">';
    $sHtml .='<h5 class="card-title">'.$obj->naziv_hrane.'</h5>';
    $sHtml .='<p class="card-text mt-auto">'.$sHtmlGramazeList.'Cijena: '.$sHtmlCijeneList.' kn'.$sHtmlKolicineList.'</p>';
 echo $sHtml .'</div>';
 echo '</div></a>';
 }
}
}
}
}

	}
	die();
}

add_action('wp_ajax_filterhrana', 'DajHranu'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_filterhrana', 'DajHranu');

//Oprema CPT
function registriraj_oprema_cpt() {

	$labels = array(
		'name'                  => _x( 'Oprema', 'Post Type General Name', 'pet' ),
		'singular_name'         => _x( 'Oprema', 'Post Type Singular Name', 'pet' ),
		'menu_name'             => __( 'Oprema', 'pet' ),
		'name_admin_bar'        => __( 'Oprema', 'pet' ),
		'archives'              => __( 'Oprema arhiva', 'pet' ),
		'attributes'            => __( 'Atributi', 'pet' ),
		'parent_item_colon'     => __( 'Roditeljski element', 'pet' ),
		'all_items'             => __( 'Sva oprema', 'pet' ),
		'add_new_item'          => __( 'Dodaj novu opremu', 'pet' ),
		'add_new'               => __( 'Dodaj novu', 'pet' ),
		'new_item'              => __( 'Nova oprema', 'pet' ),
		'edit_item'             => __( 'Uredi opremu', 'pet' ),
		'update_item'           => __( 'Ažuriraj opremu', 'pet' ),
		'view_item'             => __( 'Pogledaj opremu', 'pet' ),
		'view_items'            => __( 'Pogledaj opremu', 'pet' ),
		'search_items'          => __( 'Pretraži opremu', 'pet' ),
		'not_found'             => __( 'Nije pronađen', 'pet' ),
		'not_found_in_trash'    => __( 'Nije pronađen u smeću', 'pet' ),
		'featured_image'        => __( 'Glavna slika', 'pet' ),
		'set_featured_image'    => __( 'Postavi glavnu sliku', 'pet' ),
		'remove_featured_image' => __( 'Ukloni glavnu sliku', 'pet' ),
		'use_featured_image'    => __( 'Postavi glavnu sliku', 'pet' ),
		'insert_into_item'      => __( 'Umetni', 'pet' ),
		'uploaded_to_this_item' => __( 'Preneseno', 'pet' ),
		'items_list'            => __( 'Lista', 'pet' ),
		'items_list_navigation' => __( 'Navigacija među opremom', 'pet' ),
		'filter_items_list'     => __( 'Filtriranje opreme', 'pet' ),
	);
	$args = array(
		'label'                 => __( 'Oprema', 'pet' ),
		'description'           => __( 'Oprema post type', 'pet' ),
		'labels'                => $labels,
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon' => 'dashicons-awards',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => false,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'oprema', $args );

}
add_action( 'init', 'registriraj_oprema_cpt', 0 );

//Taksonomija tip_opreme
function registriraj_taksonomiju_tip_opreme() {
$labels = array(
'name' => _x( 'Tip opreme', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Tip opreme', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Tip opreme', 'pet' ),
'all_items' => __( 'Svi tipovi opreme', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Novi tip opreme', 'pet' ),
'add_new_item' => __( 'Dodaj novi tip opreme', 'pet' ),
'edit_item' => __( 'Uredi tip opreme', 'pet' ),
'update_item' => __( 'Ažuriraj tip opreme', 'pet' ),
'view_item' => __( 'Pogledaj tip opreme', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite tipove opreme sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni tip opreme', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularni tipovi opreme', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema tipova opreme', 'pet' ),
'items_list' => __( 'Lista tipova opreme', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'tip_opreme', array( 'oprema' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_tip_opreme', 0 );

//Taksonomija boja_opreme
function registriraj_taksonomiju_boja_opreme() {
$labels = array(
'name' => _x( 'Boja', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Boja', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Boja', 'pet' ),
'all_items' => __( 'Sve boje', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Nova boja', 'pet' ),
'add_new_item' => __( 'Dodaj novu boju', 'pet' ),
'edit_item' => __( 'Uredi boju', 'pet' ),
'update_item' => __( 'Ažuriraj boju', 'pet' ),
'view_item' => __( 'Pogledaj boju', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite boje sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni boju', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularne boje', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema boje', 'pet' ),
'items_list' => __( 'Lista boja', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'boja_opreme', array( 'oprema' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_boja_opreme', 0 );

//Taksonomija materijal_opreme
function registriraj_taksonomiju_materijal_opreme() {
$labels = array(
'name' => _x( 'Materijal', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Materijal', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Materijal', 'pet' ),
'all_items' => __( 'Svi materijali', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Novi materijal', 'pet' ),
'add_new_item' => __( 'Dodaj novi materijal', 'pet' ),
'edit_item' => __( 'Uredi materijal', 'pet' ),
'update_item' => __( 'Ažuriraj materijal', 'pet' ),
'view_item' => __( 'Pogledaj materijal', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite materijale sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni materijal', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularni materijali', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema materijala', 'pet' ),
'items_list' => __( 'Lista materijala', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'materijal_opreme', array( 'oprema' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_materijal_opreme', 0 );

//Ispis artikala opreme
function DajOpremu() {
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'oprema',
		'post_status' => 'publish',
	);
	if( isset( $_POST['zivotinjefilter'] ) )
	{
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'tip_opreme',
				'field' => 'slug',
				'terms' => $_POST['zivotinjefilter']
			)
		);
	}
 
	if( isset( $_POST['bojefilter'] ) )
	{
		$args['tax_query'][] = array(
			array(
				'taxonomy' => 'boja_opreme',
				'field' => 'slug',
				'terms' => $_POST['bojefilter']
			)
		);
	}
	$oprema = get_posts( $args );
	foreach ($oprema as $a)
	{
		$tax = get_the_terms($a->ID, 'tip_opreme');
		$oprema_cijena = get_post_meta($a->ID, 'cijena_opreme', false);
		$oprema_kolicina = get_post_meta($a->ID, 'kolicina_opreme', false);
		$oprema_naslov=$a->post_title;
		$sIstaknutaSlika="";
		if( get_the_post_thumbnail_url($a->ID) )
		{
			$sIstaknutaSlika = get_the_post_thumbnail_url($a->ID);
		}
		else
		{
			$sIstaknutaSlika = get_template_directory_uri(). '/img/noimage.png';
		}
		if($oprema_naslov!=""){
		$obj=(object)[
			'id_opreme' => $a->ID,
			'naziv_opreme' => $a->post_title,
			'istaknuta_slika' => $sIstaknutaSlika,
			'guid' => $a->guid,
			'cijene' => array(),
			'kolicine' => array()
		];
		if(!empty($tax) && !is_wp_error($tax)){
			if(!empty($oprema_cijena) && !is_wp_error($oprema_cijena)){
				if(!empty($oprema_kolicina) && !is_wp_error($oprema_kolicina)){
			$cijene=array();
			$kolicine=array();
			foreach ($oprema_cijena as $key) {

				$cij=(object)[
					'cijena_opreme' => $key
				];
				array_push($cijene, $cij);
			}

			foreach ($oprema_kolicina as $key) {
				$kol=(object)[
					'kolicina_opreme' => $key
				];
				array_push($kolicine, $kol);
			}
			array_push($obj->cijene, $cijene);
			array_push($obj->kolicine, $kolicine);
		
		echo '<a href="'.$obj->guid.'"><div class="card shadow-sm mb-4">';
	$sHtml = '<div class="card-body d-flex flex-column">';
	foreach ($obj->cijene as $cij) {
		foreach ($cij as $d) {
			$sHtmlCijeneList =$d->cijena_opreme;
		}
	}

	foreach ($obj->kolicine as $kol) {
		foreach ($kol as $c) {
			if($c->kolicina_opreme==0)
			{
				$sHtmlKolicineList='<p class="mt-auto" style="color:red;">'."Nedostupno".'</p>';
			}
			else{
				$sHtmlKolicineList='<p class="mt-auto" style="color:green;">'."Na skladištu".'</p>';
			}
		}
	}
	
  $sHtml .='<img class="card-img-top" src="'.$obj->istaknuta_slika.'" alt="Card image cap">';
    $sHtml .='<h5 class="card-title">'.$obj->naziv_opreme.'</h5>';
    $sHtml .='<p class="card-text mt-auto">Cijena: '.$sHtmlCijeneList.' kn'.$sHtmlKolicineList.'</p>';
 echo $sHtml .'</div>';
 echo '</div></a>';
}
}
}
}
		
	}
	die();
}

add_action('wp_ajax_filteroprema', 'DajOpremu'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_filteroprema', 'DajOpremu');

//Igračka CPT
function registriraj_igracka_cpt() {

	$labels = array(
		'name'                  => _x( 'Igračke', 'Post Type General Name', 'pet' ),
		'singular_name'         => _x( 'Igračke', 'Post Type Singular Name', 'pet' ),
		'menu_name'             => __( 'Igračke', 'pet' ),
		'name_admin_bar'        => __( 'Igračke', 'pet' ),
		'archives'              => __( 'Igračke arhiva', 'pet' ),
		'attributes'            => __( 'Atributi', 'pet' ),
		'parent_item_colon'     => __( 'Roditeljski element', 'pet' ),
		'all_items'             => __( 'Sve igračke', 'pet' ),
		'add_new_item'          => __( 'Dodaj novu igračku', 'pet' ),
		'add_new'               => __( 'Dodaj novu', 'pet' ),
		'new_item'              => __( 'Nova igračka', 'pet' ),
		'edit_item'             => __( 'Uredi igračku', 'pet' ),
		'update_item'           => __( 'Ažuriraj igračku', 'pet' ),
		'view_item'             => __( 'Pogledaj igračku', 'pet' ),
		'view_items'            => __( 'Pogledaj igračku', 'pet' ),
		'search_items'          => __( 'Pretraži igračke', 'pet' ),
		'not_found'             => __( 'Nije pronađen', 'pet' ),
		'not_found_in_trash'    => __( 'Nije pronađen u smeću', 'pet' ),
		'featured_image'        => __( 'Glavna slika', 'pet' ),
		'set_featured_image'    => __( 'Postavi glavnu sliku', 'pet' ),
		'remove_featured_image' => __( 'Ukloni glavnu sliku', 'pet' ),
		'use_featured_image'    => __( 'Postavi glavnu sliku', 'pet' ),
		'insert_into_item'      => __( 'Umetni', 'pet' ),
		'uploaded_to_this_item' => __( 'Preneseno', 'pet' ),
		'items_list'            => __( 'Lista', 'pet' ),
		'items_list_navigation' => __( 'Navigacija među igračkama', 'pet' ),
		'filter_items_list'     => __( 'Filtriranje igračaka', 'pet' ),
	);
	$args = array(
		'label'                 => __( 'Igracka', 'pet' ),
		'description'           => __( 'Igracka post type', 'pet' ),
		'labels'                => $labels,
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon' => 'dashicons-games',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => false,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'igracka', $args );

}
add_action( 'init', 'registriraj_igracka_cpt', 0 );

//Taksonomija tip_igracke
function registriraj_taksonomiju_tip_igracke() {
$labels = array(
'name' => _x( 'Tip igračke', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Tip igračke', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Tip igračke', 'pet' ),
'all_items' => __( 'Svi tipovi igračaka', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Novi tip igračke', 'pet' ),
'add_new_item' => __( 'Dodaj novi tip igračke', 'pet' ),
'edit_item' => __( 'Uredi tip igračke', 'pet' ),
'update_item' => __( 'Ažuriraj tip igračke', 'pet' ),
'view_item' => __( 'Pogledaj tip igračke', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite tipove igračaka sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni tip igračke', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularni tipovi igračaka', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema tipova igračaka', 'pet' ),
'items_list' => __( 'Lista tipova igračaka', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'tip_igracke', array( 'igracka' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_tip_igracke', 0 );

//Taksonomija boja_igracke
function registriraj_taksonomiju_boja_igracke() {
$labels = array(
'name' => _x( 'Boja', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Boja', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Boja', 'pet' ),
'all_items' => __( 'Sve boje', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Nova boja', 'pet' ),
'add_new_item' => __( 'Dodaj novu boju', 'pet' ),
'edit_item' => __( 'Uredi boju', 'pet' ),
'update_item' => __( 'Ažuriraj boju', 'pet' ),
'view_item' => __( 'Pogledaj boju', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite boje sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni boju', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularne boje', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema boje', 'pet' ),
'items_list' => __( 'Lista boja', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'boja_igracke', array( 'igracka' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_boja_igracke', 0 );

//Taksonomija materijal_igracke
function registriraj_taksonomiju_materijal_igracke() {
$labels = array(
'name' => _x( 'Materijal', 'Taxonomy General Name', 'pet' ),
'singular_name' => _x( 'Materijal', 'Taxonomy Singular Name', 'pet' ),
'menu_name' => __( 'Materijal', 'pet' ),
'all_items' => __( 'Svi materijali', 'pet' ),
'parent_item' => __( 'Roditeljsko zvanje', 'pet' ),
'parent_item_colon' => __( 'Roditeljsko zvanje', 'pet' ),
'new_item_name' => __( 'Novi materijal', 'pet' ),
'add_new_item' => __( 'Dodaj novi materijal', 'pet' ),
'edit_item' => __( 'Uredi materijal', 'pet' ),
'update_item' => __( 'Ažuriraj materijal', 'pet' ),
'view_item' => __( 'Pogledaj materijal', 'pet' ),
'separate_items_with_commas' => __( 'Odvojite materijale sa zarezima', 'pet' ),
'add_or_remove_items' => __( 'Dodaj ili ukloni materijal', 'pet' ),
'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'pet' ),
'popular_items' => __( 'Popularni materijali', 'pet' ),
'search_items' => __( 'Pretraga', 'pet' ),
'not_found' => __( 'Nema rezultata', 'pet' ),
'no_terms' => __( 'Nema materijala', 'pet' ),
'items_list' => __( 'Lista materijala', 'pet' ),
'items_list_navigation' => __( 'Navigacija', 'pet' ),
);
$args = array(
'labels' => $labels,
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_admin_column' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
);
register_taxonomy( 'materijal_igracke', array( 'igracka' ), $args );
}
add_action( 'init', 'registriraj_taksonomiju_materijal_igracke', 0 );

//Ispis artikala igračke
function DajIgracke() {
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'igracka',
		'post_status' => 'publish',
	);
	if( isset( $_POST['zivotinjefilter'] ) )
	{
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'tip_igracke',
				'field' => 'slug',
				'terms' => $_POST['zivotinjefilter']
			)
		);
	}
 
	if( isset( $_POST['bojefilter'] ) )
	{
		$args['tax_query'][] = array(
			array(
				'taxonomy' => 'boja_igracke',
				'field' => 'slug',
				'terms' => $_POST['bojefilter']
			)
		);
	}
	$igracke = get_posts( $args );
	foreach ($igracke as $a)
	{
		$tax = get_the_terms($a->ID, 'tip_igracke');
		$igracka_cijena = get_post_meta($a->ID, 'cijena_igracke', false);
		$igracka_kolicina = get_post_meta($a->ID, 'kolicina_igracke', false);
		$sIstaknutaSlika="";
		$igracka_naslov=$a->post_title;
		if( get_the_post_thumbnail_url($a->ID) )
		{
			$sIstaknutaSlika = get_the_post_thumbnail_url($a->ID);
		}
		else
		{
			$sIstaknutaSlika = get_template_directory_uri(). '/img/noimage.png';
		}
		if($igracka_naslov!=""){
		$obj=(object)[
			'id_igracke' => $a->ID,
			'naziv_igracke' => $a->post_title,
			'istaknuta_slika' => $sIstaknutaSlika,
			'guid' => $a->guid,
			'cijene' => array(),
			'kolicine' => array()
		];
		if(!empty($tax) && !is_wp_error($tax)){
			if(!empty($igracka_cijena) && !is_wp_error($igracka_cijena)){
				if(!empty($igracka_kolicina) && !is_wp_error($igracka_kolicina)){
			$cijene=array();
			$kolicine=array();
			foreach ($igracka_cijena as $key) {

				$cij=(object)[
					'cijena_igracke' => $key
				];
				array_push($cijene, $cij);
			}

			foreach ($igracka_kolicina as $key) {
				$kol=(object)[
					'kolicina_igracke' => $key
				];
				array_push($kolicine, $kol);
			}
			array_push($obj->cijene, $cijene);
			array_push($obj->kolicine, $kolicine);
		
		echo '<a href="'.$obj->guid.'"><div class="card shadow-sm mb-4">';
	$sHtml = '<div class="card-body d-flex flex-column">';
	foreach ($obj->cijene as $cij) {
		foreach ($cij as $d) {
			$sHtmlCijeneList =$d->cijena_igracke;
		}
	}

	foreach ($obj->kolicine as $kol) {
		foreach ($kol as $c) {
			if($c->kolicina_igracke==0)
			{
				$sHtmlKolicineList='<p class="mt-auto" style="color:red;">'."Nedostupno".'</p>';
			}
			else{
				$sHtmlKolicineList='<p class="mt-auto" style="color:green;">'."Na skladištu".'</p>';
			}
		}
	}
	
  $sHtml .='<img class="card-img-top" src="'.$obj->istaknuta_slika.'" alt="Card image cap">';
    $sHtml .='<h5 class="card-title">'.$obj->naziv_igracke.'</h5>';
    $sHtml .='<p class="card-text mt-auto">Cijena: '.$sHtmlCijeneList.' kn'.$sHtmlKolicineList.'</p>';
 echo $sHtml .'</div>';
 echo '</div></a>';
}
}
}
}

	}
	die();
}

add_action('wp_ajax_filterigracke', 'DajIgracke'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_filterigracke', 'DajIgracke');


//Ispis košarice
function daj_kosaricu()
{
	if (is_page( 'narudzba-izvrsena' ) ):
  echo "<h3 id='kosaricaprazna'>Vaša narudžba je uspješno izvršena, te će biti isporučena u najkraćem mogućem roku!</h3>";
endif;
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;

	$sHtml = "   <table border='1'>
					<thead>
					<tr>
						<th></th>
						<th>Naziv proizvoda</th>
						<th>Količina</th>
						<th>Cijena</th>
						<th></th>
					</tr>
					</thead>
					<tbody>";

		foreach ($_SESSION["shopping_cart"] as $product){
		$sHtml .= '<tr>
					<td><img src='.$product['slika_artikla'].' width="60" height="80" /></td>
					<td><a href="'.get_permalink( $product['artikl_id']).'">'.$product['naziv_artikla'].'</a></td>
					<td><form method="post" action=""><input type="number" name="nova_kol" min="1" value="'.$product['kolicina'].'"/><input type="hidden" name="artikl_id" value='.$product['artikl_id'].' /><input type="hidden" name="action" value="change" /><button type="submit" class="change"><span class="fas fa-redo-alt"></span></button></form></td>
					<td>'.number_format((float)$product['ukupnac'], 2, '.', '').' kn'.'</td>
					<td style="text-align:center;"><form method="post" action="">
<input type="hidden" name="artikl_id" value='.$product['artikl_id'].' /><input type="hidden" name="action" value="remove" /><button type="submit" class="remove"><span class="fas fa-trash-alt"></span></button></form></td>
				   </tr>';
	
				   $total_price += ($product["ukupnac"]);
}

	$sHtml .= '</tbody></table><strong>UKUPNO: '.number_format((float)$total_price, 2, '.', '').' kn</strong><div class="emptydiv" style="margin-right:10px;"><form method="post" action=""><input type="hidden" name="action" value="empty" /><button type="submit" class="empty">Ukloni sve</button></form></div><button onclick="DajFormu()" class="kosaricapotvrdi" >Potvrdi narudžbu</button>';
	return $sHtml;
}
if(!isset($_SESSION["shopping_cart"]))
{
	if (is_page( 'kosarica' ) ):
  	echo "<h3 id='kosaricaprazna'>Vaša košarica je prazna!</h3>";
endif;
}

/*else{
 echo "<h3 id='kosaricaprazna'>Vaša košarica je prazna!</h3>";
 }*/
 
}

//Dodavanje metabox-a količina i cijena za hranu
function add_meta_box_hrana()
{
	add_meta_box( 'pet_shop_hrana', 'Hrana', 'html_meta_box_hrana', 'hrana');
}
function html_meta_box_hrana($post)
{
	wp_nonce_field('spremi_detalje_hrane', 'kolicina_hrane_nonce');
	wp_nonce_field('spremi_detalje_hrane', 'cijena_hrane_nonce');
//dohvaćanje meta vrijednosti
	$hrana_kolicina = get_post_meta($post->ID, 'kolicina_hrane', true);
	$hrana_cijena = get_post_meta($post->ID, 'cijena_hrane', true);
echo '
<div>
	<div>
		<label for="kolicina_hrane">Količina: </label>
		<input type="text" id="kolicina_hrane" name="kolicina_hrane" value="'.$hrana_kolicina.'" />
	</div><br/>
	<div>
		<label for="cijena_hrane">Cijena: </label>
		<input type="text" id="cijena_hrane" name="cijena_hrane" placeholder="0.00" value="'.$hrana_cijena.'" /><span> kn</span>
	</div>
</div>';
}
function spremi_detalje_hrane($post_id)
{
	$is_autosave = wp_is_post_autosave( $post_id );
 	$is_revision = wp_is_post_revision( $post_id );
 	$is_valid_nonce_kolicina_hrane = ( isset( $_POST[ 'kolicina_hrane_nonce' ] ) && wp_verify_nonce($_POST[ 'kolicina_hrane_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 	$is_valid_nonce_cijena_hrane = ( isset( $_POST[ 'cijena_hrane_nonce' ] ) && wp_verify_nonce($_POST[ 'cijena_hrane_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
if ( $is_autosave || $is_revision || !$is_valid_nonce_kolicina_hrane) {
 	return;
 }
if(!empty($_POST['kolicina_hrane']))
{
	update_post_meta($post_id, 'kolicina_hrane', $_POST['kolicina_hrane']);
}
else
{
	delete_post_meta($post_id, 'kolicina_hrane');
}
if ( $is_autosave || $is_revision || !$is_valid_nonce_cijena_hrane) {
 	return;
 }
if(!empty($_POST['cijena_hrane']))
{
	update_post_meta($post_id, 'cijena_hrane', $_POST['cijena_hrane']);
}
else
{
	delete_post_meta($post_id, 'cijena_hrane');
}

}
add_action( 'add_meta_boxes', 'add_meta_box_hrana' );
add_action( 'save_post', 'spremi_detalje_hrane' );

//Dodavanje metabox-a količina i cijena za opremu
function add_meta_box_oprema()
{
	add_meta_box( 'pet_shop_oprema', 'Oprema', 'html_meta_box_oprema', 'oprema');
}
function html_meta_box_oprema($post)
{
	wp_nonce_field('spremi_detalje_opreme', 'kolicina_opreme_nonce');
	wp_nonce_field('spremi_detalje_opreme', 'cijena_opreme_nonce');
//dohvaćanje meta vrijednosti
	$oprema_kolicina = get_post_meta($post->ID, 'kolicina_opreme', true);
	$oprema_cijena = get_post_meta($post->ID, 'cijena_opreme', true);
echo '
<div>
	<div>
		<label for="kolicina_opreme">Količina: </label>
		<input type="text" id="kolicina_opreme" name="kolicina_opreme" value="'.$oprema_kolicina.'" />
	</div><br/>
	<div>
		<label for="cijena_opreme">Cijena: </label>
		<input type="text" id="cijena_opreme" name="cijena_opreme" placeholder="0.00" value="'.$oprema_cijena.'" /><span> kn</span>
	</div>
</div>';
}
function spremi_detalje_opreme($post_id)
{
	$is_autosave = wp_is_post_autosave( $post_id );
 	$is_revision = wp_is_post_revision( $post_id );
 	$is_valid_nonce_kolicina_opreme = ( isset( $_POST[ 'kolicina_opreme_nonce' ] ) && wp_verify_nonce($_POST[ 'kolicina_opreme_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 	$is_valid_nonce_cijena_opreme = ( isset( $_POST[ 'cijena_opreme_nonce' ] ) && wp_verify_nonce($_POST[ 'cijena_opreme_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
if ( $is_autosave || $is_revision || !$is_valid_nonce_kolicina_opreme) {
 	return;
 }
if(!empty($_POST['kolicina_opreme']))
{
	update_post_meta($post_id, 'kolicina_opreme', $_POST['kolicina_opreme']);
}
else
{
	delete_post_meta($post_id, 'kolicina_opreme');
}
if ( $is_autosave || $is_revision || !$is_valid_nonce_cijena_opreme) {
 	return;
 }
if(!empty($_POST['cijena_opreme']))
{
	update_post_meta($post_id, 'cijena_opreme', $_POST['cijena_opreme']);
}
else
{
	delete_post_meta($post_id, 'cijena_opreme');
}

}
add_action( 'add_meta_boxes', 'add_meta_box_oprema' );
add_action( 'save_post', 'spremi_detalje_opreme' );

//Dodavanje metabox-a količina i cijena za igracke
function add_meta_box_igracka()
{
	add_meta_box( 'pet_shop_igracka', 'Igracka', 'html_meta_box_igracka', 'igracka');
}
function html_meta_box_igracka($post)
{
	wp_nonce_field('spremi_detalje_igracke', 'kolicina_igracke_nonce');
	wp_nonce_field('spremi_detalje_igracke', 'cijena_igracke_nonce');
//dohvaćanje meta vrijednosti
	$igracka_kolicina = get_post_meta($post->ID, 'kolicina_igracke', true);
	$igracka_cijena = get_post_meta($post->ID, 'cijena_igracke', true);
echo '
<div>
	<div>
		<label for="kolicina_igracke">Količina: </label>
		<input type="text" id="kolicina_igracke" name="kolicina_igracke" value="'.$igracka_kolicina.'" />
	</div><br/>
	<div>
		<label for="cijena_igracke">Cijena: </label>
		<input type="text" id="cijena_igracke" name="cijena_igracke" placeholder="0.00" value="'.$igracka_cijena.'" /><span> kn</span>
	</div>
</div>';
}
function spremi_detalje_igracke($post_id)
{
	$is_autosave = wp_is_post_autosave( $post_id );
 	$is_revision = wp_is_post_revision( $post_id );
 	$is_valid_nonce_kolicina_igracke = ( isset( $_POST[ 'kolicina_igracke_nonce' ] ) && wp_verify_nonce($_POST[ 'kolicina_igracke_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 	$is_valid_nonce_cijena_igracke = ( isset( $_POST[ 'cijena_igracke_nonce' ] ) && wp_verify_nonce($_POST[ 'cijena_igracke_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
if ( $is_autosave || $is_revision || !$is_valid_nonce_kolicina_igracke) {
 	return;
 }
if(!empty($_POST['kolicina_igracke']))
{
	update_post_meta($post_id, 'kolicina_igracke', $_POST['kolicina_igracke']);
}
else
{
	delete_post_meta($post_id, 'kolicina_igracke');
}
if ( $is_autosave || $is_revision || !$is_valid_nonce_cijena_igracke) {
 	return;
 }
if(!empty($_POST['cijena_igracke']))
{
	update_post_meta($post_id, 'cijena_igracke', $_POST['cijena_igracke']);
}
else
{
	delete_post_meta($post_id, 'cijena_igracke');
}

}
add_action( 'add_meta_boxes', 'add_meta_box_igracka' );
add_action( 'save_post', 'spremi_detalje_igracke' );

//Dodavanje metabox-a količina i cijena za higijenu
function add_meta_box_higijena()
{
	add_meta_box( 'pet_shop_higijena', 'Higijena', 'html_meta_box_higijena', 'higijena');
}
function html_meta_box_higijena($post)
{
	wp_nonce_field('spremi_detalje_higijene', 'kolicina_higijene_nonce');
	wp_nonce_field('spremi_detalje_higijene', 'cijena_higijene_nonce');
//dohvaćanje meta vrijednosti
	$higijena_kolicina = get_post_meta($post->ID, 'kolicina_higijene', true);
	$higijena_cijena = get_post_meta($post->ID, 'cijena_higijene', true);
echo '
<div>
	<div>
		<label for="kolicina_higijene">Količina: </label>
		<input type="text" id="kolicina_higijene" name="kolicina_higijene" value="'.$higijena_kolicina.'" />
	</div><br/>
	<div>
		<label for="cijena_higijene">Cijena: </label>
		<input type="text" id="cijena_higijene" name="cijena_higijene" placeholder="0.00" value="'.$higijena_cijena.'" /><span> kn</span>
	</div>
</div>';
}
function spremi_detalje_higijene($post_id)
{
	$is_autosave = wp_is_post_autosave( $post_id );
 	$is_revision = wp_is_post_revision( $post_id );
 	$is_valid_nonce_kolicina_higijene = ( isset( $_POST[ 'kolicina_higijene_nonce' ] ) && wp_verify_nonce($_POST[ 'kolicina_higijene_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 	$is_valid_nonce_cijena_higijene = ( isset( $_POST[ 'cijena_higijene_nonce' ] ) && wp_verify_nonce($_POST[ 'cijena_higijene_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
if ( $is_autosave || $is_revision || !$is_valid_nonce_kolicina_higijene) {
 	return;
 }
if(!empty($_POST['kolicina_higijene']))
{
	update_post_meta($post_id, 'kolicina_higijene', $_POST['kolicina_higijene']);
}
else
{
	delete_post_meta($post_id, 'kolicina_higijene');
}
if ( $is_autosave || $is_revision || !$is_valid_nonce_cijena_higijene) {
 	return;
 }
if(!empty($_POST['cijena_higijene']))
{
	update_post_meta($post_id, 'cijena_higijene', $_POST['cijena_higijene']);
}
else
{
	delete_post_meta($post_id, 'cijena_higijene');
}

}
add_action( 'add_meta_boxes', 'add_meta_box_higijena' );
add_action( 'save_post', 'spremi_detalje_higijene' );




?>