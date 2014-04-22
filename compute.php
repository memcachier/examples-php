<?php
require 'vendor/autoload.php';
use MemCachier\MemcacheSASL;

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
$servers = explode(",", getenv("MEMCACHIER_SERVERS"));
for ($i = 0; $i < count($servers); $i++) {
  $servers[$i] = explode(":", $servers[$i]);
}

// Using Memcached client (recommended)
// ====================================
$m = new Memcached("memcached_pool");
$m->setOption(Memcached::OPT_BINARY_PROTOCOL, TRUE);
// Enable no-block for some performance gains but less certainty that data has 
// been stored.
$m->setOption(Memcached::OPT_NO_BLOCK, TRUE);
// Failover automatically when host fails.
$m->setOption(Memcached::OPT_AUTO_EJECT_HOSTS, TRUE);
// Adjust timeout. Best left at default.
// $m->setOption(Memcached::OPT_POLL_TIMEOUT, 1500);

if (!$m->getServerList()) {
  // We use a consistent connection to memcached, so only add in the servers 
  // first time through otherwise we end up duplicating our connections to the 
  // server.
  $m->addServers($servers);
}
$m->setSaslAuthData(getenv("MEMCACHIER_USERNAME"), getenv("MEMCACHIER_PASSWORD"));

// Enable MemCachier session support
session_start();
$_SESSION['test'] = 42;

// Using MemcacheSASL client
// =========================
// $m = new MemcacheSASL();
// if (!$m->getServerList()) {
//   $m->addServers($servers);
// }
// $m->setSaslAuthData(getenv("MEMCACHIER_USERNAME"), getenv("MEMCACHIER_PASSWORD"));

// ================
// Using the cache!
// ================

// Get the value from the cache.
$in_cache = $m->get($n);
if ($in_cache) {
  $message = "hit";
  $prime = $in_cache;
} else {
  $why = $m->getResultCode();
  $message = "miss (".$why.")";
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
