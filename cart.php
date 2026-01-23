<?php
session_start();

// ... sav ostali kod za logiku korpe ...

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>
<!doctype html>
<html lang="sr">
<head>
  <meta charset="utf-8">
  <title>Korpa - Nenagraf</title>
  <style>
    /* ... vaši stilovi ... */
     body{font-family:Arial;margin:20px;background:#f6f7f9}
    table{width:100%;border-collapse:collapse;background:#fff}
    th,td{padding:10px;border:1px solid #e5e7ea;text-align:left}
    .right{text-align:right}
    .btn{padding:8px 12px;border:none;border-radius:6px;background:#0b6ea8;color:#fff;cursor:pointer}
    .danger{background:#c0392b}
    form.inline{display:inline}
    .summary{margin-top:14px;padding:12px;background:#fff;border:1px solid #e5e7ea;border-radius:6px}
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 5px;
    }
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border-color: #c3e6cb;
    }
    .alert-error {
      background-color: #f8d7da;
      color: #721c24;
      border-color: #f5c6cb;
    }
  </style>
</head>
<body>
  <h1>Vaša korpa</h1>

  <?php
  // Prikaz poruke o uspehu na osnovu GET parametra
  if (isset($_GET['status']) && $_GET['status'] === 'success') {
      echo '<div class="alert alert-success">Hvala! Vaša porudžbina je uspešno poslata.</div>';
  }

  // Prikaz poruke o grešci na osnovu GET parametra
  if (isset($_GET['status']) && $_GET['status'] === 'error') {
      echo '<div class="alert alert-error">Došlo je do greške prilikom slanja porudžbine. Molimo vas da pokušate ponovo.</div>';
  }

  // Prikaz grešaka iz sesije (ako ih ima)
  if (isset($_SESSION['form_errors']) && !empty($_SESSION['form_errors'])) {
      echo '<div class="alert alert-error">';
      echo '<ul>';
      foreach ($_SESSION['form_errors'] as $error) {
          echo '<li>' . htmlspecialchars($error) . '</li>';
      }
      echo '</ul>';
      echo '</div>';
      unset($_SESSION['form_errors']); // Uklonite greške nakon prikaza


  }
  if (isset($_GET['remove'])) {
    $key = $_GET['remove'];
    unset($_SESSION['cart'][$key]);
    header("Location: cart.php");
    exit;
}
  ?>

  <?php if(empty($cart)): ?>
    <p>Korpa je prazna. <a href="cenovnik.php">Nazad na cenovnik</a></p>
  <?php else: ?>
    <!-- Ostatak vašeg HTML koda za korpu -->
     <form method="post">
      <table>
        <thead>
          <tr><th>Proizvod</th><th>Varijanta</th><th>Količina</th><th>Cena/kom</th><th>Ukupno</th><th>Ukloni</th></tr>
        </thead>
        <tbody>
          <?php foreach($cart as $key => $item): 
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
          ?>
            <tr>
              <td><?php echo htmlspecialchars($item['name']); ?></td>
              <td><?php echo htmlspecialchars($item['variant']); ?></td>
              <td>
                <input type="number" name="quantities[<?php echo $key ?>]" value="<?php echo $item['quantity'] ?>" min="100" step="100">
              </td>
              <td><?php echo number_format($item['price'],2,',','') ?> RSD</td>
              <td><?php echo number_format($subtotal,2,',','') ?> RSD</td>
              <td><a href="cart.php?remove=<?php echo $key ?>" onclick="return confirm('Ukloniti stavku?')">Ukloni</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div style="margin-top:10px;">
        <button type="submit" name="update_cart" class="btn">Ažuriraj korpu</button>
        <a href="cenovnik.php" style="margin-left:10px">Nastavi sa kupovinom</a>
      </div>
    </form>

    <div class="summary">
      <p><strong>Ukupno: <?php echo number_format($total,2,',','') ?> RSD</strong></p>

      <h3>Podaci za porudžbinu</h3>
      <form method="post" action="process_order.php">
        <label>Ime i prezime:<br><input type="text" name="name" required></label><br><br>
        <label>Email:<br><input type="email" name="email" required></label><br><br>
        <label>Telefon:<br><input type="text" name="phone" required></label><br><br>
        <label>Adresa za dostavu:<br><textarea name="address" rows="3" ></textarea></label><br><br>
        <button class="btn" type="submit">Pošalji porudžbinu</button>
      </form>
    </div>
  <?php endif; ?>
</body>
</html>


