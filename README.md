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

This example uses the [PHP Memcached
client](http://www.php.net/manual/en/book.memcached.php) to connect
with MemCachier. This is our recommended client, it supports the full
protocol and has great performance.

We also support the
[MemCachier\MemcacheSASL](http://github.com/memcachier/PHPMemcacheSASL)
PHP client to connect to and interact with MemCachier. We highly
recommend the PHP Memcached client over MemcacheSASL though as
MemcacheSASL doesn't support working with more than one server.

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

