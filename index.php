<!DOCTYPE html>
<html>
<head>
  <title>Memcachier Primes Example</title>
  <script src="/jquery-1.7.2.js" type="text/javascript"></script>
  <script src="/main.js" type="text/javascript"></script>
</head>
<body>

  <h1>MemCachier Primes Example</h1>
  <p>For any number N, we'll find the largest prime number less than or equal to N.  Because our implementation is incredibly basic, we don't accept N greater than 1,000.  When you submit the form, we'll check the cache to see if we've calculated the largest prime for N. If we get a hit, we'll return the results from the cache.  If not, we'll do the calculation.</p>

  <input type="text" id="n" />
  <input type="button" value="Submit" data-compute="true" />

  <p id="prime"></p>

</body>
</html>
