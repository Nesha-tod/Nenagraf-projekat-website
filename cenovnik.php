<?php
session_start();



/* ---------- REMOVE FROM CART ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_cart'])) {
    $key = $_POST['cart_key'] ?? '';
    if ($key && isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]);
    }
    header("Location: cenovnik.php");
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* ---------- ADD TO CART ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id = (int)($_POST['product_id'] ?? 0);
    $name = trim($_POST['product_name'] ?? '');
    $variant = trim($_POST['product_variant'] ?? '');
    $price = (float)str_replace(',', '.', $_POST['product_price'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 0);

    if ($id && $name && $price > 0 && $quantity > 0) {
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        $cartKey = md5($id . '|' . $variant);
        if (isset($_SESSION['cart'][$cartKey])) {
            $_SESSION['cart'][$cartKey]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$cartKey] = [
                'product_id' => $id,
                'name' => $name,
                'variant' => $variant,
                'price' => $price,
                'quantity' => $quantity
            ];
        }
    }
    header("Location: cenovnik.php");
    exit;
}

// ... ostatak koda ...

/* ---------- PRODUCTS DEFINITION (IDs 1..12) ---------- */
/* Update image paths as needed */
$products = [
    1 => [
        'name' => 'Kutija za roštilj i pečenje',
        'images' => ['kutije/kutija-rostilj-05-1.png','kutije/kutija-rostilj-1kg-1.png','kutije/kutija-rostilj-3kg-1.png'],
        'variants' => ['0.5kg'=>22.00,'1-2kg'=>35.00,'3-4kg'=>45.00],
        'min'=>100,'step'=>100
    ],
    2 => [
        'name' => 'Kutije za hamburgere',
        'images' => ['kutije/ambalaza-za-hamburger-247x296.jpg','kutije/kutije-za-hamburgere.jpg','kutije/burger_box.jpg'],
        'price' => 19.00,
        'min'=>100,'step'=>100
    ],
    3 => [
        'name' => 'Kutija za pomfrit',
        'images' => ['kutije/Kutija-za-pomfrit-mala-510x510.jpg','kutije/img_20250821_141235-removebg-preview.png'],
        'variants' => ['Mala'=>6.00,'Velika'=>9.00],
        'min'=>100,'step'=>100
    ],
    4 => [
        'name' => 'Kutija za pirošku',
        'images' => ['kutije/Kutija-za-pirosku.jpg','kutije/Kutija-za-pirosku-otvorena.jpg'],
        'variants' => ['Bez folije'=>63.00,'Sa folijom'=>63.00],
        'min'=>50,'step'=>50
    ],
    5 => [
        'name' => 'Kutija za tortu sa ručkom',
        'images' => ['kutije/Mockup-Cardboard-Cake-Box-Carry-Packaging-For-Fast-Food-Meal-on-transparent-background-PNG.png','kutije/kutija_za_tortu_2.jpg'],
        'variants' => ['Mala'=>44.00,'Srednja'=>90.00,'Velika'=>90.00],
        'min'=>25,'step'=>25
    ],
    6 => [
        'name' => 'Kutija za tortu bez ručke',
        'images' => ['kutije/Kutije-za-kolače-14-510x510.jpg','kutije/kutija-za-tortu-36x46x18-set-5-kom~2071.jpg'],
        'variants' => ['Mala'=>88.00,'Srednja'=>91.00],
        'min'=>25,'step'=>25
    ],
    7 => [
        'name' => 'Kutija za rolat i šnit',
        'images' => ['kutije/Rolat-mali-1.jpg','kutije/download.jpg'],
        'variants' => ['Mala'=>41.00,'Srednja'=>47.00,'Velika'=>89.00],
        'min'=>50,'step'=>50
    ],
    8 => [
        'name' => 'Nosač za čaše',
        'images' => ['kutije/nosač-za-dve-čaše-kafe-510x510.jpg','kutije/download (7)_cleanup.jfif'],
        'variants' => ['Nosač za dve čaše'=>17.00,'Nosač za četiri čaše'=>25.00],
        'min'=>100,'step'=>100
    ],
    9 => [
        // PODMETAČ ZA TORTU - DIMENZIJE x MATERIJAL (combo)
        'name' => 'Podmetač za tortu',
        'images' => ['kutije/Podmetac-TV2-247x296.jpg'],
        'variants' => [
            '20x20' => ['Lepenka'=>28.00],
            '30x30' => ['Lepenka'=>74.00,'Karton'=>59.00],
            '33x33' => ['Lepenka'=>79.00],
            '30x45' => ['Lepenka'=>101.00,'Karton'=>62.00],
            '38x50' => ['Lepenka'=>103.00,'Karton'=>76.00]
        ],
        'min'=>25,'step'=>25
    ],
    10 => [
        'name' => 'Podmetač za tortu okrugli',
        'images' => ['kutije/download (8).jfif','kutije/download (9).jfif'],
        'variants' => ['17cm'=>41.00,'20cm'=>41.00,'27cm'=>68.00,'30cm'=>71.00,'33cm'=>72.00],
        'min'=>25,'step'=>25
    ],
    11 => [
        'name' => 'Podmetač za rolat',
        'images' => ['kutije/download (10).jfif','kutije/download (11).jfif'],
        'variants' => ['26x13cm'=>23.00,'43x17cm'=>64.00,'43x17cm VAL'=>45.00],
        'min'=>25,'step'=>25
    ],
    12 => [
        'name' => 'Papirni podmetač',
        'images' => ['kutije/papir1.jpg','kutije/papir2.jpg'],
        // quantities => price per unit (RSD/kom)
        'quantities' => ['1000'=>9.00,'3000'=>5.00,'5000'=>4.00,'10000'=>3.00,'15000'=>2.50]
        // bulk: user chooses quantity from select; no +/-; we will set hidden quantity to the chosen value
    ],
    13 => [
      'name' => 'Kutija za parče pice',
      'images' => ['kutije/Kutija-za-parce-pice-768x768.jpg','kutije/download.jfif','kutije/download (1).jfif'],
      'price' =>17.00,
      'min' =>100,'step' =>100
    ],
    14 => [
      'name' => 'Podmetač za parče pice',
      'images' => ['kutije/download (2).jfif','kutije/download (3).jfif','kutije/download__4_-removebg-preview.png'],
      'variants' => ['50/6'=>4.00],
      'min'=>1000, 'step'=>1000
    ],
    15 => [
      'name' => 'Kutija za pomfrit sa poklopcem',
      'images'=> ['kutije/img_20250821_140711-removebg-preview.png','kutije/img_20250821_140632-removebg-preview.png'],
      'price'=>15.00,
      'min' =>100, 'step' =>100
    ]
];

/* ---------- CART SUMMARY ---------- */
$cartCount = 0;
$cartTotal = 0.0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $k => $item) {
        $cartCount += $item['quantity'];
        $cartTotal += ($item['price'] * $item['quantity']);
    }
}
?>


<!doctype html>
<html lang="sr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Cenovnik ambalaže i štampe — Nenagraf / Timbox</title>
<meta name="description" content="Pogledajte naš cenovnik za izradu ambalaže i reklamnog materijala. Nudimo konkurentne cene za kutije, papirne kese, flajere i brošure. Kontaktirajte nas za prilagođene ponude.">
<meta name="keywords" content="cenovnik, ambalaža, kutije, papirne kese, reklamni materijal, flajeri, brošure, cene ambalaže, izrada ambalaže">
<meta name="robots" content="index, follow">
<style>
  :root{--accent:#0b6ea8;--green:#28a745}
  *{box-sizing:border-box;}
  body{font-family:Arial,Helvetica,sans-serif;margin:0;padding:0;background:#f6f7f9;color:#222}
  header{position:sticky;background:#1e293b;color:#fff;padding:20px 20px;display:flex;flex-direction:column;justify-content:space-between;gap:10px;z-index:120}
  header .korpa a{text-decoration:none;color:#fff;padding:0 20px}
  .logo-img img{display:block;height:60px}
  .logo{font-size:32px;font-weight:bold;text-align:center;padding-right:40px}
  .logo p{font-size:22px;text-align:center;margin:0}
  .logo a{text-decoration:none;color:#fff;text-align:center}
 .heading{display:flex;align-items:center;justify-content:center;gap:40px}
  header .heading h1{margin:0;font-size:28px}
  #nav-links ul{list-style:none;display:flex;align-items:center;justify-content:center;background:#006680;gap:70px;padding:10px;margin:0}
  #nav-links ul li a:hover{color:yellow}
  #nav-links a{text-decoration:none;color:#fff;font-size:1.1rem;opacity:0.7}
  #nav-links ul li a.active:link{text-decoration: underline;opacity:1.0;font-weight:bold}
  .hamburger{display:none;cursor:pointer;color:#fff;font-size:2rem}
  
  .cart-btn{background:transparent;border:0;color:#fff;cursor:pointer;font-size:16px}
  .wrap{max-width:1100px;margin:20px auto;padding:0 16px}
  .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:18px}
  .product{background:#fff;border:1px solid #e5e7ea;border-radius:8px;padding:14px;box-shadow:0 2px 6px rgba(0,0,0,0.05)}
  .slider{position:relative;overflow:hidden;border-radius:6px;background:#f2f4f6;padding:8px}
  .slides img{width:100%;display:none;height:220px;object-fit:contain;border-radius:6px}
  .slides img.active{display:block}
  .prev,.next{position:absolute;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.45);color:#fff;padding:8px;border-radius:50%;cursor:pointer;user-select:none}
  .prev{left:12px}.next{right:12px}
  .thumbs{display:flex;gap:8px;justify-content:center;margin-top:10px}
  .thumbs img{width:60px;height:40px;object-fit:cover;border-radius:4px;cursor:pointer;border:2px solid transparent}
  .thumbs img.active{border-color:var(--accent)}
  h3{margin:12px 0 6px 0;color:var(--accent);font-size:18px}
  .row{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
  .price{font-weight:700;color:var(--accent);margin:10px 0}
  .price-total{font-size:0.95rem;color:#444;margin-left:8px}
  .controls{display:flex;align-items:center;gap:8px;margin-top:8px}
  .controls button{padding:6px 10px;border-radius:6px;border:1px solid #ccc;background:#fff;cursor:pointer}
  .controls input[type="number"]{width:110px;padding:6px;border-radius:6px;border:1px solid #ccc;text-align:center}
  .addbtn{margin-top:10px;background:var(--green);border:none;color:#fff;padding:10px 14px;border-radius:6px;cursor:pointer}
  .addbtn:hover{opacity:.95}
  label{font-size:13px;color:#333}
  select{padding:6px;border-radius:6px;border:1px solid #ccc}
  
  /* cart modal */
  .cart-modal{position:fixed;right:20px;top:70px;background:#fff;border:1px solid #ddd;padding:12px;border-radius:8px;width:360px;box-shadow:0 8px 30px rgba(0,0,0,.15);display:none;z-index:2000}
  .cart-modal.open{display:block}
  .cart-item{display:flex;justify-content:space-between;gap:12px;padding:8px 0;border-bottom:1px solid #f1f1f1}
  .cart-item:last-child{border-bottom:none}
  .small{font-size:13px;color:#666}
  .remove-btn{background:#ff4d4d;border:0;color:#fff;padding:6px 8px;border-radius:6px;cursor:pointer}
@media (max-width:768px){ .wrap{padding:0 12px} .cart-modal{right:10px;left:10px;width:auto} #nav-links{display:none;flex-direction:column;background:#222;position:absolute;width:50%;z-index:1000;right:0;top:100px} #nav-links.show{display:flex} #nav-links ul{display:flex;flex-direction:column;background:#222} .hamburger{display:block}}
</style>
</head>
<body>

<header>
  <div class="heading">
  <div class="logo-img"><img src="slike/file.svg" alt="logo kompanije"></div>
  <div class="logo"><a href="index.php"><h1>TIMBOX - NENAGRAF</h1></a><a href="index.php"><p>Izrada ambalaže i reklamnog materijala</p></a></div>
  <div style="display:flex;align-items:center;gap:12px" class="korpa">
    <div class="small" style="color:#fff">Ukupno: <strong id="cart-total-hero"><?php echo number_format($cartTotal,2,',',''); ?> RSD</strong></div>
   <a href="cart.php">🛒 Korpa (<?= count($_SESSION['cart']) ?>)</a>
</div>
<div class="hamburger" onclick="toggleMenu()">&#9776</div>
  </div>
  </header>
   <div id="nav-links">
                <nav class="nav">
                    <ul>
                        <li><a href="index.php">Početna</a></li>
                        <li><a href="o_nama.php">O nama</a></li>
                        <li><a href="cenovnik.php" class="active">Cenovnik</a></li>
                        <li><a href="usluge.php">Usluge</a></li>
                        <li><a href="galerija.php">Galerija</a></li>
                        <li><a href="kontakt.php">Kontakt</a></li>
                    </ul>
                </nav>
            </div>


<!-- CART MODAL -->
<div class="cart-modal" id="cart-modal" aria-hidden="true">
  <h4>Korpa</h4>
  <?php if (empty($_SESSION['cart'])): ?>
    <p class="small">Korpa je prazna.</p>
  <?php else: ?>
    <?php $grand = 0; foreach($_SESSION['cart'] as $key => $it): 
        $line = $it['price'] * $it['quantity'];
        $grand += $line;
    ?>
      <div class="cart-item">
        <div style="flex:1">
          <div><strong><?php echo htmlspecialchars($it['name']); ?></strong></div>
          <div class="small"><?php echo htmlspecialchars($it['variant']); ?> — <?php echo $it['quantity']; ?> kom</div>
        </div>
        <div style="text-align:right">
          <div><strong><?php echo number_format($line,2,',',''); ?> RSD</strong></div>
          <form method="post" style="margin-top:6px">
            <input type="hidden" name="cart_key" value="<?php echo htmlspecialchars($key); ?>">
            <button class="remove-btn" name="remove_cart" type="submit">Ukloni</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
    <div style="padding-top:8px;text-align:right"><strong>Ukupno: <?php echo number_format($grand,2,',',''); ?> RSD</strong></div>
  <?php endif; ?>
</div>

<div class="wrap">
  <div class="grid">
    <?php foreach($products as $pid => $p) {
    // compute first price shown
    $firstPrice = 0.0;
    if (isset($p['price'])) $firstPrice = $p['price'];
    elseif (isset($p['variants'])) {
        $firstKey = array_key_first($p['variants']);
        if (is_array($p['variants'][$firstKey])) {
            $innerKey = array_key_first($p['variants'][$firstKey]);
            $firstPrice = $p['variants'][$firstKey][$innerKey];
        } else {
            $firstPrice = $p['variants'][$firstKey];
        }
    } elseif (isset($p['quantities'])) {
        $firstBulkKey = array_key_first($p['quantities']);
        $firstPrice = $p['quantities'][$firstBulkKey];
    }
?>
<div class="product" id="product-<?php echo $pid; ?>">
    <div class="slider">
        <div class="slides" id="slides-<?php echo $pid; ?>">
            <?php foreach($p['images'] as $i => $img) { ?>
                <img src="<?php echo htmlspecialchars($img); ?>" class="<?php echo $i===0 ? 'active' : ''; ?>" alt="">
            <?php } ?>
        </div>
        <div class="prev" onclick="changeSlide('slides-<?php echo $pid; ?>', -1, 'thumbs-<?php echo $pid; ?>')">❮</div>
        <div class="next" onclick="changeSlide('slides-<?php echo $pid; ?>', 1, 'thumbs-<?php echo $pid; ?>')">❯</div>
    </div>

    <div class="thumbs" id="thumbs-<?php echo $pid; ?>">
        <?php foreach($p['images'] as $i => $img) { ?>
            <img src="<?php echo htmlspecialchars($img); ?>" class="<?php echo $i===0 ? 'active' : ''; ?>" onclick="showSlide('slides-<?php echo $pid; ?>', <?php echo $i; ?>, 'thumbs-<?php echo $pid; ?>')">
        <?php } ?>
    </div>

    <h3><?php echo htmlspecialchars($p['name']); ?></h3>

    <form method="post" action="cenovnik.php">
        <!-- VARIANTS / COMBO / BULK -->
        <?php if (isset($p['variants'])) {
            $firstVariantKey = array_key_first($p['variants']);
            if (is_array($p['variants'][$firstVariantKey])) {
                // combo (ID=9)
                $dims = array_keys($p['variants']);
                $firstDim = array_key_first($p['variants']);
                $materials = array_keys($p['variants'][$firstDim]);
        ?>
            <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:8px">
                <div>
                    <label for="dim-<?php echo $pid; ?>">Dimenzije</label><br>
                    <select id="dim-<?php echo $pid; ?>" onchange="updateComboPrice(<?php echo $pid; ?>)">
                        <?php foreach($dims as $d) { ?><option value="<?php echo htmlspecialchars($d); ?>"><?php echo htmlspecialchars($d); ?></option><?php } ?>
                    </select>
                </div>
                <div>
                    <label for="mat-<?php echo $pid; ?>">Materijal</label><br>
                    <select id="mat-<?php echo $pid; ?>" onchange="updateComboPrice(<?php echo $pid; ?>)">
                        <?php foreach($materials as $m) { ?><option value="<?php echo htmlspecialchars($m); ?>"><?php echo htmlspecialchars($m); ?></option><?php } ?>
                    </select>
                </div>
            </div>
        <?php } else {
            // simple variants (e.g., ID=1) ?>
            <div style="margin-top:8px">
                <label for="variant-<?php echo $pid; ?>">Varijanta</label><br>
                <select id="variant-<?php echo $pid; ?>" onchange="updatePrice(<?php echo $pid; ?>)">
                    <?php foreach($p['variants'] as $vlabel => $vprice) { ?>
                        <option value="<?php echo htmlspecialchars($vlabel); ?>" data-price="<?php echo $vprice; ?>"><?php echo htmlspecialchars($vlabel); ?> — <?php echo number_format($vprice,2,',',''); ?> RSD</option>
                    <?php } ?>
                </select>
            </div>
        <?php }
        } elseif (isset($p['price'])) {
            // fixed price product (e.g., ID=2, 8) ?>
            <div style="margin-top:8px"><div class="small"></div></div>
        <?php } elseif (isset($p['quantities'])) {
            // bulk product (ID=12) ?>
            <div style="margin-top:8px">
                <label for="bulk-<?php echo $pid; ?>">Količina</label><br>
                <select id="bulk-<?php echo $pid; ?>" onchange="updatePriceBulk(<?php echo $pid; ?>)">
                    <?php foreach($p['quantities'] as $q => $ppu) { ?>
                        <option value="<?php echo $q; ?>" data-price="<?php echo $ppu; ?>"><?php echo htmlspecialchars($q); ?> kom — <?php echo number_format($ppu,2,',',''); ?> RSD/kom</option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>

        <div class="price">
            Cena: <span id="price-<?php echo $pid; ?>"><?php echo number_format($firstPrice,2,',',''); ?></span> RSD/kom
            <?php if (isset($p['quantities'])): ?>
                <span class="price-total" id="price-total-<?php echo $pid; ?>">Ukupno: <?php echo number_format($firstPrice * (int)array_key_first($p['quantities']),2,',',''); ?> RSD</span>
            <?php endif; ?>
        </div>

        <?php if (isset($p['quantities'])): ?>
            <!-- bulk product: quantity comes from select -->
            <input type="hidden" name="quantity" id="hiddenQty-<?= $pid ?>" value="<?php echo array_key_first($p['quantities']); ?>">
        <?php else: ?>
            <div class="controls">
                <button type="button" onclick="changeQty(<?php echo $pid; ?>, -<?php echo ($p['step'] ?? 1); ?>, <?php echo ($p['min'] ?? 1); ?>)">−</button>
                <input type="number" id="qty-<?php echo $pid; ?>" name="quantity" value="<?php echo ($p['min'] ?? 1); ?>" min="<?php echo ($p['min'] ?? 1); ?>" step="<?php echo ($p['step'] ?? 1); ?>">
                <button type="button" onclick="changeQty(<?php echo $pid; ?>, <?php echo ($p['step'] ?? 1); ?>, <?php echo ($p['min'] ?? 1); ?>)">+</button>
            </div>
            <input type="hidden" name="quantity" id="hiddenQty-<?= $pid ?>" value="<?= ($p['min'] ?? 1) ?>">
        <?php endif; ?>

        <input type="hidden" name="add_to_cart" value="1">
        <input type="hidden" name="product_id" value="<?= $pid ?>">
        <input type="hidden" name="product_name" value="<?= htmlspecialchars($p['name']) ?>">
        <input type="hidden" name="product_variant" id="hiddenVariant-<?= $pid ?>">
        <input type="hidden" name="product_price" id="hiddenPrice-<?= $pid ?>">
        <button type="submit" class="addbtn" id="add-to-cart-<?= $pid ?>">Dodaj u korpu</button>
    </form>
</div>
<?php } // endforeach products ?>

  </div>
</div>

<?php
require 'footer.php';
?>

<script>
/* --- JS data from PHP --- */
const products = <?php echo json_encode($products, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP); ?>;

/* --- cart modal toggle --- */
const cartToggle = document.getElementById('cart-toggle');
const cartModal = document.getElementById('cart-modal');

if (cartToggle && cartModal) {
  cartToggle.addEventListener('click', ()=> {
    cartModal.classList.toggle('open');
    const expanded = cartModal.classList.contains('open');
    cartToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
  });
}

/* --- hamburger menu --- */
function toggleMenu() {
        document.getElementById("nav-links").classList.toggle("show");
    }

/* --- sliders --- */
function changeSlide(slidesId, n, thumbsId){
  const slides = document.querySelectorAll(`#${slidesId} img`);
  const thumbs = document.querySelectorAll(`#${thumbsId} img`);
  if (!slides.length) return;
  let idx = Array.from(slides).findIndex(s => s.classList.contains('active'));
  if (idx < 0) idx = 0;
  slides[idx].classList.remove('active'); if (thumbs[idx]) thumbs[idx].classList.remove('active');
  idx = (idx + n + slides.length) % slides.length;
  slides[idx].classList.add('active'); if (thumbs[idx]) thumbs[idx].classList.add('active');
}
function showSlide(slidesId, index, thumbsId){
  const slides = document.querySelectorAll(`#${slidesId} img`);
  const thumbs = document.querySelectorAll(`#${thumbsId} img`);
  slides.forEach(s=>s.classList.remove('active'));
  thumbs.forEach(t=>t.classList.remove('active'));
  if (slides[index]) slides[index].classList.add('active');
  if (thumbs[index]) thumbs[index].classList.add('active');
}

/* --- price updates for simple variant --- */
function updatePrice(pid){
  const sel = document.getElementById('variant-'+pid);
  if(!sel) return;
  const price = parseFloat(sel.options[sel.selectedIndex].dataset.price);
  document.getElementById('price-'+pid).innerText = price.toFixed(2).replace('.',',');
  document.getElementById('hiddenPrice-'+pid).value = price;
  document.getElementById('hiddenVariant-'+pid).value = sel.value;
}

/* --- combo update for ID=9 (dimensions + material) --- */
function updateComboPrice(pid){
  const dimSel = document.getElementById('dim-'+pid);
  const matSel = document.getElementById('mat-'+pid);
  if(!dimSel || !matSel) return;
  const dim = dimSel.value;

  // get object for this product from products JS data
  const data = products[pid]['variants'];
  const dimObj = data[dim];

  const prevMat = matSel.value;

  // rebuild material options to exactly match available materials for selected dimension
  matSel.innerHTML = '';
  for (const m in dimObj) {
    const opt = document.createElement('option');
    opt.value = m;
    opt.textContent = m;
    matSel.appendChild(opt);
  }

  if (prevMat && dimObj[prevMat]) {
    matSel.value = prevMat;
  }

  // choose first material (or keep existing if present)
  let chosenMat = matSel.value;
  if (!chosenMat) chosenMat = matSel.options[0].value;

  const price = parseFloat(dimObj[chosenMat]);
  document.getElementById('price-'+pid).innerText = price.toFixed(2).replace('.',',');
  document.getElementById('hiddenPrice-'+pid).value = price;
  document.getElementById('hiddenVariant-'+pid).value = dim + ' / ' + chosenMat;
}

/* --- bulk (ID=12) update: unit + total --- */
function updatePriceBulk(pid){
  const sel = document.getElementById('bulk-'+pid);
  if(!sel) return;
  const ppu = parseFloat(sel.options[sel.selectedIndex].dataset.price);
  const qty = parseInt(sel.value);
  document.getElementById('price-'+pid).innerText = ppu.toFixed(2).replace('.',',');
  document.getElementById('hiddenPrice-'+pid).value = ppu;
  document.getElementById('hiddenVariant-'+pid).value = qty + ' kom';
  // update hidden qty field
 const hiddenQtyInput = document.getElementById('hiddenQty-'+pid);
  if (hiddenQtyInput) hiddenQtyInput.value = qty;
  
  // update total display
  const totalEl = document.getElementById('price-total-'+pid);
  if (totalEl) {
    const total = ppu * qty;
    totalEl.innerText = 'Ukupno: ' + total.toFixed(2).replace('.',',') + ' RSD';
  }
}

/* --- quantity controls --- */
function changeQty(pid, delta, min){
  const el = document.getElementById('qty-'+pid);
  if(!el) return;
  let v = parseInt(el.value) || min;
  v = v + delta;
  if (v < min) v = min;
  const step = parseInt(el.getAttribute('step')) || min;
  v = Math.round(v / step) * step;
  if (v < min) v = min;
  el.value = v;
}

/* --- sync hidden fields before submit --- */
function syncHiddenForProduct(pid){
  // simple variants
  const variantSel = document.getElementById('variant-'+pid);
  if (variantSel) {
    const price = parseFloat(variantSel.options[variantSel.selectedIndex].dataset.price);
    document.getElementById('hiddenPrice-'+pid).value = price;
    document.getElementById('hiddenVariant-'+pid).value = variantSel.value;
  }
  // combo (ID=9)
  const dimSel = document.getElementById('dim-'+pid);
  const matSel = document.getElementById('mat-'+pid);
  if (dimSel && matSel) {
    // ensure mat list up-to-date and values set
    updateComboPrice(pid);
  }
  // bulk
  const bulkSel = document.getElementById('bulk-'+pid);
  if (bulkSel) {
    updatePriceBulk(pid);
  }
  const qtyInput = document.getElementById('qty-'+pid);
  const hiddenQtyInput = document.getElementById('hiddenQty-'+pid);
  if (qtyInput && hiddenQtyInput) {
    hiddenQtyInput.value = qtyInput.value;
  }
  return true;
}

/* --- initialize UI with defaults --- */
document.addEventListener('DOMContentLoaded', function(){

document.querySelectorAll('.addbtn').forEach(button => {
    button.addEventListener('click', function(event) {
      const form = this.closest('form');
      if (form) {
        event.preventDefault(); // Prevent the default form submission for now
        
        // This is a crucial step to ensure hidden fields are up-to-date
        const pid = form.querySelector('input[name="product_id"]').value;
        syncHiddenForProduct(pid);

        // Optional: Log the form data to the console for verification
        const formData = new FormData(form);
        for (const [key, value] of formData.entries()) {
          console.log(`${key}: ${value}`);
        }
        
        // Now, submit the form to trigger the PHP script
        form.submit();
      }
    });
  });

  for (const pid in products) {
    const p = products[pid];
    // nested combo
    if (p.variants) {
      const firstKey = Object.keys(p.variants)[0];
      if (typeof p.variants[firstKey] === 'object') {
        const dimSel = document.getElementById('dim-'+pid);
        const matSel = document.getElementById('mat-'+pid);
        if (dimSel && matSel) {
          // set dim to first and populate materials
          dimSel.value = firstKey;
          updateComboPrice(pid);
        }
      } else {
        // simple variant
        const sel = document.getElementById('variant-'+pid);
        if (sel) {
          const price = parseFloat(sel.options[sel.selectedIndex].dataset.price);
          document.getElementById('hiddenPrice-'+pid).value = price;
          document.getElementById('hiddenVariant-'+pid).value = sel.value;
          document.getElementById('price-'+pid).innerText = price.toFixed(2).replace('.',',');
        }
      }
    } else if (p.price !== undefined) {
      const hp = document.getElementById('hiddenPrice-'+pid);
      if (hp) hp.value = p.price;
      const hv = document.getElementById('hiddenVariant-'+pid);
      if (hv) hv.value = 'standard';
    } else if (p.quantities) {
      // bulk
      const sel = document.getElementById('bulk-'+pid);
      if (sel) updatePriceBulk(pid);
    }
  }
});
</script>
</body>
</html>





