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
        <a href="o_nama.php" class="cta-saznaj-vise">Saznajte više</a>
    </section>

    <section class="usluge" id="proizvodi">
        <h2>Naše usluge</h2>

        <div class="usluga">

        <div class="grid-item">
            <img src="slike/slika5_kutija_sushi.jpg" alt="Kutija za sushi">
            <h3>Izrada kutija za ugostiteljstvo</h3>
            <p>Pružamo <strong>širok asortiman kutija za ugostiteljstvo,</strong> prilagođen potrebama restorana, keteringa, fast food objekata i drugih ugostiteljskih delatnosti.</p>
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
            <a href="reklamni_materijali.php" class="cta-detaljnije">Detaljnije</a>
        </div>

        </div>

    </section>
   
</main>

<?php
require 'footer.php';
?>