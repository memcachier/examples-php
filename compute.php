<?
include('MemcacheSASL.php');

$n = intval($_GET["n"]);
if ($n <= 1) {
  echo "N must be greater than 1";
  exit;
}
if ($n > 1000) {
  $n = 1000;
}

$m = new MemcacheSASL;
$m->addServer($_ENV["MEMCACHIER_SERVERS"], '11211');
$m->setSaslAuthData($_ENV["MEMCACHIER_USERNAME"], $_ENV["MEMCACHIER_PASSWORD"]);

$in_cache = $m->get($n);
if ($in_cache) {
  $prime = $in_cache;
  $message = "hit";
} else {
  $message = "miss";
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
  $m->add($n, $prime);
}
?>

<?= $prime ?><br />
cache: <?= $message ?>