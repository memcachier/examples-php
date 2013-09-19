<?Php
include('MemcacheSASL.php');

// pass 'n' argument
if (!isset($_GET["n"])) {
  echo "N must be set!";
  exit;
}
$n = intval($_GET["n"]);
if ($n <= 1) {
  echo "N must be greater than 1";
  exit;
} else if ($n > 10000) {
  $n = 10000;
}

// ==========================
// Make MemCachier connection
// ==========================
//
// Using MemcacheSASL client (recommended)
// =======================================
// $m = new MemcacheSASL;
// $servers = explode(",", getenv("MEMCACHIER_SERVERS"));
// foreach ($servers as $s) {
//   $parts = explode(":", $s);
//   $m->addServer($parts[0], $parts[1]);
// }
// $m->setSaslAuthData(getenv("MEMCACHIER_USERNAME"), getenv("MEMCACHIER_PASSWORD"));

// Using Memcached client
// ======================
$m = new Memcached();
if (!$m->setOption(Memcached::OPT_BINARY_PROTOCOL, true)) {
  echo "Error switching to memcached binary protocol!";
  exit;
}
$servers = explode(",", getenv("MEMCACHIER_SERVERS"));
for ($i = 0; $i < count($servers); $i++) {
  $servers[$i] = explode(":", $servers[$i]);
}
$m->addServers($servers);
foreach ($servers as $s) {
  $parts = explode(":", $s);
  if (!$m->addServer($parts[0], $parts[1])) {
    echo "Error adding in MemCachier servers!";
    exit;
  }
}
$m->setSaslAuthData(getenv("MEMCACHIER_USERNAME"), getenv("MEMCACHIER_PASSWORD"));


// ================
// Using the cache!
// ================

// Get the value from the cache.
$in_cache = $m->get($n);
if ($in_cache) {
  $message = "hit";
  $prime = $in_cache;
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
