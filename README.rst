# DEPRECATED

This project is no longer beeing developed. 

MemcacheBundle
~~~~~~~~~~~~~~

This is a simple bundle that creates a memcached service that you can use. 

Note: The service supports creating both PHP Memcache extensions (i.e. both http://php.net/memcache and http://php.net/memcached), BUT it does not protect you
from differences in the two services interfaces as it returns the raw object.

Instalation
-----------

Add to deps::

    [SMMemcacheBundle]
        git=git://github.com/tarjei/MemcacheBundle.git
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
    sm_memcache:
        use_mock: true

Usage
-----

The service is named sm_memcache, it returns a normal \Memcache or \Memcached php object::

    $memcached = $container->get("sm_memcache");
    $memcached->set("someKey", "somevalue");


The service is just the normal Memcache object (http://php.net/memcache) so you can use the normal methods.

For tests there is a special MockMemcache object that you can use to stub out the memcache service.

Options
-----
If you use Memcached class, you can pass options to instance in config. Example::

    sm_memcache:
        port: 11211
        host: localhost
        class: Memcached
        options:
            igbinary:
                name: serializer
                value: serializer_igbinary

This example sets `Memcached::OPT_SERIALIZER` to `Memcached::SERIALIZER_IGBINARY`
Before applying options are converted in following format:

* option name is converted to Memcached::OPT_*UPPERCASE_NAME* constant
* option value is converted to Memcached::\*UPPERCASE_NAME\*

If you use Memcache class, options block is ignored.

TODO
----
 * Support multiple memcache servers.
 * Support more methods in the mock module.
