<?php
get_header();
 $sIstaknutaSlika = get_template_directory_uri(). '/img/petfood.png';
?>

<header class="masthead" style="background-image: url(<?php echo $sIstaknutaSlika; ?>)">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h2>
            <h1>Hrana</h1>
          </h2>
        <span class="subheading"></span>
        </div>
      </div>
    </div>
  </div>
</header>

 
<main>
<?php
echo $forma='<form style="margin-left:10px;" class="filter" action="'; echo site_url(); echo '/wp-admin/admin-ajax.php" method="POST" id="filter">
   <span style="color:#a3a3a3;">Vrsta</span><br>';
    if( $terms = get_terms( array( 'taxonomy' => 'tip_hrane') ) ) : 
    foreach($terms as $term) {
       echo '<label class="filterlabel"><input class="filterinput" type="checkbox" name="zivotinjefilter[]"  value="' . $term->slug .'">' . ' '. $term->name.'</label>';
    }
    echo '<input type="hidden" name="action" value="filterhrana">';
    endif;

    echo '<br><span style="color:#a3a3a3;">Pakiranje</span><br>';
    if( $terms = get_terms( array( 'taxonomy' => 'pakiranja') ) ) : 
    foreach($terms as $term) {
       echo '<label class="filterlabel"><input class="filterinput" type="checkbox" name="pakiranjafilter[]"  value="' . $term->slug .'">' . ' '. $term->name.'</label>';
    }
    echo '<input type="hidden" name="action" value="filterhrana">';
  endif;
echo '</form>';


?>

<div class="response">
  <?php $hrana=DajHranu();
  echo $hrana['response'];
  ?>
</div>
</main>
 
 
<?php
get_footer();
?>