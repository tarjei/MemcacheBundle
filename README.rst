MemcacheBundle
~~~~~~~~~~~~~~

This is a simple bundle that creates a memcached service that you can use.

Instalation
-----------

Add to deps::

    [SMMemcacheBundle]
        git=git://github.com:tarjei/MemcacheBundle.git
        target=/bundles/SM/MemcacheBundle


Then register the bundle with your kernel::

    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new SM\Memcache\SMMemcacheBundle(),
        // ...
    );

Make sure that you also register the namespaces with the autoloader::

    // app/autoload.php
    $loader->registerNamespaces(array(
        // ...
        'SM\\MemcacheBundle' => __DIR__ . '/../vendor/bundles',
    ));

Configuration
-------------

In your prod/dev environment::

    # app/config/config.yml
    memcache:
        use_mock: false
        port: 11211
        host: localhost

In your test environment::

    # app/config/config.yml
    memcache:
        use_mock: true


Usage
-----

The service is just the normal Memcache object (http://no.php.net/memcache) so you can use the normal methods.

For tests there is a special MockMemcache object that you can use to stub out the memcache service.

