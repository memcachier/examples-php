MemCachier Primes Example
=====

This is an example PHP app that uses MemCachier to cache prime number computations in Heroku.

You can view a working version of this app at [memachier-primes.herokuapp.com](http://memachier-primes.herokuapp.com/).  Running this app on your local machine in
development will work as well, although you'll need to setup memcached locally.  MemCachier is currently
only available in Heroku.

Library Support
-----

This example uses the [PHPMemcacheSASL](http://github.com/ronnywang/PHPMemcacheSASL) PHP client to connect to and interact with MemCachier.
