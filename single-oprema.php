<?php 
get_header();

$oprema_cijena = get_post_meta($post->ID, 'cijena_opreme', true);
$oprema_kolicina = get_post_meta($post->ID, 'kolicina_opreme', true);
$sNazivOpreme=$post->post_title;
$sCijena='Cijena: '.$oprema_cijena.' Kn';
$sArtikala="";
if($oprema_kolicina=="" || $oprema_kolicina==0)
{
    $sArtikala='<span style="color:red;"> nedostupno</span>';
}
else
{
    $sArtikala= '<span style="color:green;"> na skladištu </span><span style="color:black;">('.$oprema_kolicina.')</span>';   
}

$sKolicina='Dostupnost artikla: '.$sArtikala;

echo '<header class="masthead">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
          </div>
        </div>
      </div>
</header>';

echo'<div style="display: none;" id="dodanokosarica">Dodano u košaricu</div>';
echo'<div style="display: none;" id="nedovoljnoartikala">Unesena količina nije dostupna!</div>';
echo'<div style="display: none;" id="kriviunoskolicine">Niste unijeli valjanu količinu artikla!</div>';
if ( have_posts() )
{
    while ( have_posts() )
    {
        the_post();
 
        $sIstaknutaSlika = "";
        if( get_the_post_thumbnail_url($post->ID) )
        {
            $sIstaknutaSlika = get_the_post_thumbnail_url($post->ID);
        }
        else
        {
            $sIstaknutaSlika = get_template_directory_uri(). '/img/download.png';
        }

    $sveboje=array();
    $Boje = wp_get_post_terms( $post->ID, 'boja_opreme' );
    if(sizeof($Boje)>0)
    {
        foreach ($Boje as $key) {

            array_push($sveboje, $key->name);
        }
    }

    $sBoja=implode(", ", $sveboje);

    if($sBoja=="")
    {
        $sBoja="nepoznato";
    }

    $svimaterijali=array();
    $Materijali = wp_get_post_terms( $post->ID, 'materijal_opreme' );
    if(sizeof($Materijali)>0)
    {
       foreach ($Materijali as $key) {

            array_push($svimaterijali, $key->name);
        }
    }

    $sMaterijal=implode(", ", $svimaterijali);

    if($sMaterijal=="")
    {
        $sMaterijal="nepoznato";
    }
    
        $PostContent=get_the_content();
        echo '<div class="row">
                <div class="col-md-6" style="text-align:center;"><img class="slikasingle" src="'.$sIstaknutaSlika.'" alt=""></div>
                <div class="col-md-6" style="text-align:;"><h3 class="nazivsingle">'.$sNazivOpreme.'</h3><h4 class="dodatnosingle">Boja: '.$sBoja.'</h4><h4 class="dodatnosingle">Materijal: '.$sMaterijal.'</h4><h5 class="cijenasingle">'.$sCijena.'</h5><input type="number" id="odabrana_kolicina" value="1" min="1"><button class="button">Dodaj</button><h6>'.$sKolicina.'</h6></div>
                <div class="col-md-8" style="text-align:;"><h3 class="opissingle1"><h3 class="opissingle2">Opis proizvoda</h3></h3><h4 class="opissingle">'.nl2br($PostContent).'</h4></div>
                
                
            </div>';
            /*if($PostContent!=""){
                echo '<div class="col-md-8" style="text-align:;"><h3 class="opissingle1"><h3 class="opissingle2">Opis proizvoda</h3></h3><h4 class="opissingle">'.nl2br($PostContent).'</h4></div>';
            }*/

    }
}

get_footer(); 
?>

<script language="JavaScript">
$(document).ready(function() {
    var dostupna_kolicina = "<?php echo $oprema_kolicina ?>";
            $('.button').click(function () {
                var broj_artikala=document.getElementById("odabrana_kolicina").value;
                var cijena = "<?php echo $oprema_cijena ?>";
                var ukupno=parseFloat(cijena);
                var ukupno2=ukupno.toFixed(2);
                var ukupno3=parseFloat(cijena)*broj_artikala;
                var ukupno4=ukupno3.toFixed(2);
                var dostupnost=(dostupna_kolicina-broj_artikala);
                var slika="<?php echo $sIstaknutaSlika ?>";
                if(broj_artikala<=0)
                {
                    document.getElementById("kriviunoskolicine").style.display="block";
                    setTimeout(function () {
                    window.location = window.location;
                    }, 1000);
                    //alert("Niste unijeli valjanu količinu artikla!");
                }
                else if(dostupna_kolicina>0 && dostupnost>=0)
                {
                    $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'custom_update_post',
                post_id: <?php echo $post->ID?>,
                naziv_artikla : "<?php echo $post->post_title?>",
                slika_artikla : slika,
                nova_kolicina : dostupnost,
                odabrana_kolicina : broj_artikala,
                cijena_artikla : ukupno2,
                ukupna_cijena : ukupno4
                }
                });
                    //alert("Dodano u Vašu košaricu");
                    document.getElementById("dodanokosarica").style.display="block";
                    setTimeout(function () {
                    window.location = window.location;
                    }, 1000);
                    //window.location=window.location;
                }
                else
                {
                    document.getElementById("nedovoljnoartikala").style.display="block";
                    setTimeout(function () {
                    window.location = window.location;
                    }, 1000);
                    //alert("Unesena količina nije dostupna!");
                }
                return false;
            });
        });
</script>