<?php
get_header();
$sImageUrl = get_template_directory_uri().'/img/naslovna.png';
echo '<header class="masthead" style="background-image: url('.$sImageUrl.')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>'; echo wp_title(''); echo '</h1>
               <span class="subheading">Sve za Vaše ljubimce</span>
            </div>
          </div>
        </div>
      </div>
</header>';
?>
<?php
if ( have_posts() )
{
  while ( have_posts() )
  {
    the_post();
    $sIstaknutaSlika = "";
    if(get_the_post_thumbnail_url($post->ID))
    {
      $sIstaknutaSlika = get_the_post_thumbnail_url($post->ID);
    }
    else
    {
      $sIstaknutaSlika = get_template_directory_uri().'/img/naslovna.png';
    }

    echo '<div class="row" style="margin-right: 0px; margin-bottom: 30px;border-bottom: 2px solid #9E9E9E;">
            <div class="col-md-6" style="text-align:center;"><img class="" style="width:60%" src="'.$sIstaknutaSlika.'" alt=""></div>
            <div class="col-md-6" style="text-align:center;"><h1>'.nl2br($post->post_title).'</h1><br>'.nl2br($post->post_content).'</div>
          </div>';
  }
}
get_footer();
?>
