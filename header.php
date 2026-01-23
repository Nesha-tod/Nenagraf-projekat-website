<?php 
  // Ovo uzima samo ime fajla iz URL-a (npr. index.php)
  $current_page = basename($_SERVER['PHP_SELF']); 
?>


<!DOCTYPE html>
<html lang="sr">
    <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  <title>
    <?php
        if (isset($naslov_stranice)) {
            echo $naslov_stranice . " | Timbox Nenagraf";
        } else {
            echo "Timbox Nenagraf - Izrada ambalaže i reklamnog materijala";
        }
        ?>
  </title>
    <meta name="description" content="<?php echo isset($opis_stranice) ? $opis_stranice : 'Timbox - Nenagraf je specijalizovana radionica za izradu svih vrsta ambalaže i reklamnog materijala.'; ?>">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="ambalaža, kartonske kutije, papirne kese, reklamni materijal, flajeri, brošure, posteri, izrada ambalaže, pakovanje proizvoda">
  
</head>
<body>
    <header>
           <div class="brand">
            <div class="logo"><a href="index.php"><img src="slike/file.svg" alt="Logotip firme"></a></div>
            <div class="naziv_firme">
                <h1>Timbox - Nenagraf</h1>
                <p>Izrada ambalaže i reklamnog materijala</p>
            </div>
            </div>
        <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
        <div id="nav">
        <nav>
            <ul>
                <li><a class="<?php if ($current_page == 'index.php') {echo 'current';} ?>" href="index.php">Početna</a></li>
                <li><a class="<?php if ($current_page == 'o_nama.php') {echo 'current';} ?>" href="o_nama.php">O nama</a></li>
                <li><a class="<?php if ($current_page == 'cenovnik.php') {echo 'current';} ?>" href="cenovnik.php">Cenovnik</a></li>
                <li><a class="<?php if ($current_page == 'usluge.php') {echo 'current';} ?>" href="usluge.php">Usluge</a></li>
                <li><a class="<?php if ($current_page == 'galerija.php') {echo 'current';} ?>" href="galerija.php">Galerija</a></li>
                <li><a class="<?php if ($current_page == 'kontakt.php') {echo 'current';} ?>" href="kontakt.php">Kontakt</a></li>
            </ul>
</nav>
            </div>
</header>
    