<?
$n = intval($_GET["n"]);
if ($n <= 1) {
  echo "N must be greater than 1";
  exit;
}
if ($n > 1000) {
  $n = 1000;
}

$prime = 1;
for ($i = $n; $i > 1; $i--) {
  $is_prime = true;
  for ($j = 2; $j < $i; $j++) {
    if ($i % $j == 0) {
      $is_prime = false;
      break;
    }
  }
  if ($is_prime) {
    $prime = $i;
    break;
  }
}
?>

<?= $prime ?>