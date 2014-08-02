<?php

namespace SM\MemcacheBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SMMemcacheExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (!$config['use_mock']) {
            if (false == (isset($config['class']) && $config['class'] != "" && class_exists($config['class']))) {
                /* we prefer the new Extension. */
                if (class_exists('\\Memcached')) {
                    $config['class']= 'Memcached';
                } elseif (class_exists('Memcache')) {
                    $config['class'] = 'Memcache';
                } else {
                    throw new \Exception('No memcached extension found. Please install one.');
                }
            }
        }
        $container->setParameter('sm_memcache.host', $config['host']);
        $container->setParameter('sm_memcache.port', $config['port']);
        $container->setParameter('sm_memcache.use_mock', $config['use_mock']);
        $container->setParameter('sm_memcache.factory', $config['factory']);
        $container->setParameter('sm_memcache.class', $config['class']);
        $definition = $container->getDefinition('sm_memcache');
        $definition->setClass($config['class']);
        $options = array();
        foreach ($config['options'] as $option) {
            $optionName = constant('Memcached::OPT_' . strtoupper($option['name']));
            $optionValue = constant('Memcached::' . strtoupper($option['value']));
            $options[$optionName] = $optionValue;
        }
        $definition->replaceArgument(4, $options);
    }
}
