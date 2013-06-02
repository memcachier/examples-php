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
} else if ($n > 1000) {
  $n = 1000;
}

// ==========================
// Make MemCachier connection
// ==========================
//
// Using Memcached client (recommended)
// ====================================
$m = new Memcached();
if (!$m->setOption(Memcached::OPT_BINARY_PROTOCOL, true)) {
  echo "Error switching to memcached binary protocol!";
  exit;
}
// XXX: MEMCACHIER_SERVERS is a string like "mc1.ec2.memcachier.com:11211, 
// mc2.ec2.memcachier.com:11211" so it should actually be parsed and 
// `addServer` called multiple times. Simplifying for now and assuming only one 
// MemCachier proxy.
if (!$m->addServer($_ENV["MEMCACHIER_SERVERS"], '11211')) {
  echo "Error adding in MemCachier servers!";
  exit;
}
$m->setSaslAuthData($_ENV["MEMCACHIER_USERNAME"], $_ENV["MEMCACHIER_PASSWORD"]);

// Using MemcacheSASL client
// =========================
// $m = new MemcacheSASL;
// $m->addServer('localhost:11211', '11211');
// $m->setSaslAuthData($_ENV["MEMCACHIER_USERNAME"], $_ENV["MEMCACHIER_PASSWORD"]);


// ================
// Using the cache!
// ================

// Get the value from the cache.
$in_cache = $m->get($n);
if ($in_cache) {
  $message = "hit";
  $prime = $in_cache;
} else if ($m->getResultCode() == Memcached::RES_NOTFOUND) {
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
} else {
  /* log error */
  $prime = 1;
  $message = $m->getResultCode() + ": " + $m->getResultMessage();
}
?>

<?= $prime ?><br />
cache: <?= $message ?>
