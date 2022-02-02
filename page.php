<?php
  get_header();

  $sImageUrl = get_template_directory_uri().'/img/naslovna.png';
    

    echo'<header class="masthead" style="background-image: url('.$sImageUrl.')">
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
    ?>
    <main class="flextable">
        <?php
            echo daj_kosaricu();
        ?>
<form style="display:none;" id="forma" action="" method="post">
  <div class='row'>
    <div class='col-75'>
      <div class='container'>

        <div class='row2'>
          <div class='col-50'>
            <h3>Adresa</h3>
            <label for='fname'><i class='fa fa-user'></i> Ime prezime</label>
            <input type='text' id='fname' name='fname' minlength="6" maxlength="150" placeholder='Unesite ime i prezime' required="">
            <label for='email'><i class='fa fa-envelope'></i> Email</label>
            <input type='email' id='email' name='email' placeholder='ivo@ivic.com' required="">
            <div class='row'>
              <div class='col-50'>
                <label for='adress'><i class='fa fa-address-card-o'></i> Adresa</label>
                <input type='text' id='adress' name='address' minlength="5" placeholder='Unesite naziv ulice' required="">
              </div>
              <div class='col-50'>
                <label for='br'>Kućni broj</label>
                <input type='number' id='br' name='br' placeholder='' min="1" max="999" required="">
              </div>
            </div>
            <label for='city'><i class='fa fa-institution'></i> Grad</label>
            <input type='text' id='city' name='city' minlength="3" placeholder='Unesite ime grada' required="">

            <div class='row'>
              <div class='col-50'>
                <label for='state'>Država</label>
                <input type='text' id='state' name='state' minlength="2" maxlength="3" placeholder='HR' required="">
              </div>
              <div class='col-50'>
                <label for='zip'>Poštanski broj</label>
                <input type='number' id='zip' name='zip' min="10000" max="54000" placeholder='' required="">
              </div>
            </div>
          </div>

          <div class='col-50'>
            <h3>Plaćanje</h3>
            <label for='fname'>Kartice</label>
            <div class='icon-container'>
              <i class='fab fa-cc-visa' style='color:navy;'></i>
              <i class='fab fa-cc-amex' style='color:blue;'></i>
              <i class='fab fa-cc-mastercard' style='color:red;'></i>
              <i class='fab fa-cc-discover' style='color:orange;'></i>
            </div>
            <label for='cname'>Ime na kartici</label>
            <input type='text' id='cname' name='cname' minlength="5" placeholder='Unesite ime sa kartice' required="">
            <label for='ccnum'>Broj kartice</label>
            <input type='tel' id='ccnum' name='ccnum' inputmode="numeric" pattern="[0-9\s]{19,19}"  placeholder='1111 2222 3333 4444' required="">
            <label for='expmonth'>Mjesec isteka</label>
            <input type='text' id='expmonth' name='expmonth' minlength="5" maxlength="8" placeholder='Unesite mjesec isteka' required="">

            <div class='row'>
              <div class='col-50'>
                <label for='expyear'>Godina isteka</label>
                <input type='number' id='expyear' name='expyear' min="2021" max="2026" placeholder='' required="">
              </div>
              <div class='col-50'>
                <label for='cvv'>CVV</label>
                <input type='number' id='cvv' name='cvv' min="100" max="999" placeholder='' required="">
              </div>
            </div>
          </div>

        </div>
        <form method='post' action=''><input type='hidden' name='action' value='potvrda' /><button type='submit' class='btn'>Završi narudžbu</button></form>
        <button type='submit' onclick="SakrijFormu()" class='btn2'>Odustani</button>
      </div>
    </div>
  </div>
</form>
<script>
  function DajFormu() {
    document.getElementById("forma").style.display = "block";
  }
  function SakrijFormu(){
    document.getElementById("forma").style.display = "none";
  }

  $(document).ready(function() {
    $('.btn').click(function () {
      $(".btn").validate();
    });
    if($(".btn").isValid())
    {
      $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
        action: 'potvrda',
              }
        });
    }
  });
 

 
</script>
        
    </main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


<?php
  get_footer();
?>

            


