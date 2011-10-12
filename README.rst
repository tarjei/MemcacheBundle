MemcacheBundle
~~~~~~~~~~~~~~

This is a simple bundle that creates a memcached service that you can use. The service works with both PHP Memcache extensions (i.e. both http://php.net/memcache and http://php.net/memcached)

Instalation
-----------

Add to deps::

    [SMMemcacheBundle]
        git=git://github.com:tarjei/MemcacheBundle.git
        target=/bundles/SM/MemcacheBundle


Then register the bundle with your kernel::

    
    // app/AppKernel.php
    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new SM\MemcacheBundle\SMMemcacheBundle(),
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
    sm_memcache:
        use_mock: false
        port: 11211
        host: localhost

In your test environment::

    # app/config/config.yml
    memcache:
        use_mock: true


Usage
-----

The service is just the normal Memcache object (http://php.net/memcache) so you can use the normal methods.

For tests there is a special MockMemcache object that you can use to stub out the memcache service.

TODO
----
 * Support multiple memcache servers.
 * Support more methods in the mock module.
