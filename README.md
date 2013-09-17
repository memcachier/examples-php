# MemCachier PHP Example

This is an example PHP app that uses
[MemCachier](http://www.memcachier.com) to cache prime number
computations.

You can view a working version of this app
[here](http://memachier-examples-php.herokuapp.com/) that uses
[MemCachier on Heroku](https://addons.heroku.com/memcachier). Running
this app on your local machine in development will work as well,
although you'll need to install a local memcached server. MemCachier
is currently only available with various cloud providers.

## Client

This example uses the
[PHPMemcacheSASL](http://github.com/ronnywang/PHPMemcacheSASL) PHP
client to connect to and interact with MemCachier.

The [Memcached](http://php.net/manual/en/book.memcached.php) PHP
client that comes distributed with PHP also works well with
MemCachier.

## Running

The application is setup to work on Heroku or another cloud platform
that the MemCachier caching service is available on. However, you can
run locally against [memcached](http://memcached.org) by changing the
server and authentication data. Then simply run:

~~~~ .sh
$ php -S localhost:3000 -t .
~~~~

## Get involved!

We are happy to receive bug reports, fixes, documentation enhancements,
and other improvements.

Please report bugs via the
[github issue tracker](http://github.com/memcachier/examples-php/issues).

Master [git repository](http://github.com/memcachier/examples-php):

* `git clone git://github.com/memcachier/examples-php.git`

## Licensing

This library is BSD-licensed.

