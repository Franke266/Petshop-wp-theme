<?php 
get_header();
 the_post();
$sImageUrl =get_the_post_thumbnail_url($post->ID);
    echo '
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('.$sImageUrl.')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
            <h1>'; echo the_title(); echo '</h1>
            <span class="subheading"></span>
            </div>
        </div>
        </div>
    </div>
    </header>';


         $PostContent=get_the_content();
        echo '<div class="row">
                <div class="col-md-6" style="text-align:center;"><img class="" src="'.$sIstaknutaSlika.'" alt=""></div>
                <div class="col-md-6" style="text-align:;">'.nl2br($PostContent).'</div>
            </div>';

get_footer(); 
?>