<?php 
get_header();

$hrana_cijena = get_post_meta($post->ID, 'cijena_hrane', true);
$hrana_kolicina = get_post_meta($post->ID, 'kolicina_hrane', true);
$sNazivHrane=$post->post_title;
$sCijena='Cijena: '.$hrana_cijena.' Kn';
$sArtikala="";
if($hrana_kolicina=="" || $hrana_kolicina==0)
{
    $sArtikala='<span style="color:red;"> nedostupno</span>';
}
else
{
    $sArtikala= '<span style="color:green;"> na skladištu </span><span style="color:black;">('.$hrana_kolicina.')</span>';   
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

    $svegramaze=array();
    $Gramaza = wp_get_post_terms( $post->ID, 'gramaza' );
    if(sizeof($Gramaza)>0)
    {
        foreach ($Gramaza as $key) {

            array_push($svegramaze, $key->name);
        }
    }

    $sGramaza=implode(", ", $svegramaze);

    if($sGramaza=="")
    {
        $sGramaza="nepoznato";
    }

    $svapakiranja=array();
    $Pakiranje = wp_get_post_terms( $post->ID, 'pakiranja' );

    if(sizeof($Pakiranje)>0)
    {
        foreach ($Pakiranje as $key) {

            array_push($svapakiranja, $key->name);
        }
    }

    $sPakiranje=implode(", ", $svapakiranja);

    if($sPakiranje=="")
    {
        $sPakiranje="nepoznato";
    }


        $PostContent=get_the_content();
        echo '<div class="row">
                <div class="col-md-6" style="text-align:center;"><img class="slikasingle" src="'.$sIstaknutaSlika.'" alt=""></div>
                <div class="col-md-6" style="text-align:;"><h3 class="nazivsingle">'.$sNazivHrane.","." ".$sGramaza.'</h3><h4 class="dodatnosingle">Pakiranje: '.$sPakiranje.'</h4><h5 id="cijena" class="cijenasingle">'.$sCijena.'</h5><input type="number" id="odabrana_kolicina" value="1" min="1"><button class="button">Dodaj</button><h6 class="kolicina">'.$sKolicina.'</h6></div>
                <div class="col-md-8" style="text-align:;"><h3 class="opissingle1"><h3 class="opissingle2">Opis proizvoda</h3></h3><h4 class="opissingle">'.nl2br($PostContent).'</h4></div>
                
            </div>';


    }
}




?>
<script language="JavaScript">
$(document).ready(function() {
    var dostupna_kolicina = "<?php echo $hrana_kolicina ?>";
            $('.button').click(function () {
                var broj_artikala=document.getElementById("odabrana_kolicina").value;
                var cijena = "<?php echo $hrana_cijena ?>";
                var ukupno=parseFloat(cijena);
                var ukupno2=ukupno.toFixed(2);
                var ukupno3=parseFloat(cijena)*broj_artikala;
                var ukupno4=ukupno3.toFixed(2);
                var dostupnost=(dostupna_kolicina-broj_artikala);
                var test =document.getElementById("nedovoljnoartikala").style.display="block";
                var test2 =document.getElementById("nedovoljnoartikala").style.display="none";
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

<?php
get_footer(); 
?>