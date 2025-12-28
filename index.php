<?php
require 'header.php';
?>

<main>
    <section class="hero-slider">
        <div class="slider" id="slide1"></div>
        <div class="slider" id="slide2"></div>
        <div class="slider" id="slide3"></div>
        <div class="slider" id="slide4"></div>
        <div class="overlay-text">
            <h2>Izrada ambalaže po meri</h2>
            <h3>Izrađujemo kutije za prehrambenu, kozmetičku, tehničku i farmaceutsku industriju.</h3>
            <div class="CTA">
            <div><a href="#proizvodi" class="cta-product">Proizvodi</a></div>
            <div><a href="kontakt.php" class="cta-button">Zatražite ponudu</a></div>
            <div><a href="cenovnik.php" class="cta-price">Cenovnik</a></div>
        </div>
        </div>    
    </section>
    <div class="blok"></div>

    <section class="o-nama">
        <h2>O nama</h2>
        <p>TIMBOX - NENAGRAF je specijalizovana radionica za izradu svih vrsta ambalaže - od kartonskih kutija do elegantnih papirnih kesa sa logotipom. Pored ambalaže, bavimo se i izradom reklamnog materijala kao što su flajeri, brošure i posteri. Naš cilj je da vaš proizvod dobije profesionalno pakovanje koje odražava vaš brend.</p>

        <div class="slideshows-container">
        <div class="slideshow">
            <span class="arrow left">&#10094;</span>
            <span class="arrow right">&#10095;</span>
            <img src="slike/slika9_kutija_pomfrit_poklopac.png" alt="Kutija za pomfrit sa poklopcem" class="active">
            <img src="slike/slika10_kutija_pomfrit_poklopac_otvorena.png" alt="Otvorena kutija za pomfrit sa poklopcem">
            <img src="slike/slika11_kutija_pomfrit.png" alt="Kutija za pomfrit bez poklopca">
            <img src="slike/slika12_kutija_pomfrit_zuta.png" alt="Kutija za pomfrit žuta">
        </div>

        <div class="slideshow">
            <span class="arrow left">&#10094;</span>
            <span class="arrow right">&#10095;</span>
            <img src="slike/slika13_sushi_veliki_set.png" alt="Velika kutija za sushi" class="active">
            <img src="slike/slika15_sushi_mala_kutija.png" alt="Mala kutija za sushi">
            <img src="slike/slika16_set_kutija_sushi.png" alt="Set kutija za sushi">
            <img src="slike/slika17_sushi_srednja_kutija.png" alt="Srednja kutija za sushi">
        </div>

        <div class="slideshow">
            <span class="arrow left">&#10094;</span>
            <span class="arrow right">&#10095;</span>
            <img src="slike/slika18_kutija_kolac_rucka.jpg" alt="Kutija za kolač rucka" class="active">
            <img src="slike/slika19_kutija_rolat_rucka.jpg" alt="Kutija za rolat rucka">
            <img src=slike/slika20_kutija_rolat_mali.jpg alt="Kutija za mali rolat">
            <img src="slike/slika21_podmetaci_torta.jpg" alt="Podmetači za tortu">
        </div>

        <div class="slideshow">
            <span class="arrow left">&#10094;</span>
            <span class="arrow right">&#10095;</span>
            <img src="slike/slika22_burger_set_kutija.png" alt="Burger set kutija" class="active">
            <img src="slike/slika23_burger_box.jpg" alt="Burger box">
            <img src="slike/slika24_kutija_blanko_hamburger.jpg" alt="Kutija blanko hamburger">
            <img src="slike/slika25_burger_velika_kutija.png" alt="Velika burger kutija">
        </div>
    </div>

    <a href="o_nama.php" class="cta-saznaj-vise">Saznajte više</a>

    </section>

    <section class="usluge" id="proizvodi">
        <h2>Naše usluge</h2>

        <h3>Izrada ambalaže po meri za različite industrije</h3>

        <div class="usluga">

        <div class="grid-item">
            <img src="slike/slika5_kutija_sushi.jpg" alt="Kutija za sushi">
            <h3>Izrada kutija za ugostiteljstvo</h3>
            <p>Pružamo <strong>širok asortiman kutija za ugostiteljstvo,</strong> prilagođen potrebama restorana, keteringa, fast food objekata i drugih ugostiteljskih delatnosti.</p>
            <br>
            <a href="fast_food.php" class="cta-detaljnije">Detaljnije</a>
        </div>

        <div class="grid-item">
            <img src="slike/slika6_kutija_sa_tortom.jpg" alt="Kutija za tortu">
            <h3>Slatki program</h3>
            <p>Nudimo širok asortiman kutija za torte, kolače, šnitove, komadne i sitne kolače. Takođe izrađujemo podmetače za torte u svim veličinama, uz mogućnost štampanja vašeg logotipa tehnikom foliotiska ili ofset štampe.</p>
            <a href="slatki_program.php" class="cta-detaljnije">Detaljnije</a>
         </div>

        <div class="grid-item">
            <img src="slike/slika8_poklon_kutija.png" alt="Luksuzna poklon kutija">
            <h3>Elegantne lux kutije i unikatna ambalaža za poklone</h3>
            <p>Elegancija u svakom detalju – naše luksuzne kutije sa debelom lepenkom pružaju savršenu kombinaciju čvrstine, modernog dizajna i prestiža. Idealne su za poklone, premium proizvode i ekskluzivnu ambalažu koja ostavlja snažan utisak.</p>
            <a href="poklon_kutije.php" class="cta-detaljnije">Detaljnije</a>
        </div>

        <div class="grid-item">
            <img src="slike/img_kese_sa_logotipom.svg" alt="Reklamne kese sa logotipom">
            <h3>Reklamni materijali</h3>
            <p>Reklamne papirne kese sa vašim logotipom, idealne za prodavnice i događaje.</p>
            <br>
            <br>
            <a href="reklamni_materijali.php" class="cta-detaljnije">Detaljnije</a>
        </div>
        </div>
    </section>

    <section class="bottom-slajder">
        <div class="bottom-slide" id="bottom-slide1"></div>
        <div class="bottom-slide" id="bottom-slide2"></div>
        <div class="bottom-slide" id="bottom-slide3"></div>
        <div class="bottom-slide" id="bottom-slide4"></div>
    </section>
   
</main>

<?php
require 'footer.php';
?>