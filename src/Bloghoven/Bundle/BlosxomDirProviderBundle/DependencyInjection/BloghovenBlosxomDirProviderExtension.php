<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BloghovenBlosxomDirProviderExtension extends Extension
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

        $this->updateProviderDataDir($container, $config);
    }

    protected function updateProviderDataDir(ContainerBuilder $container, $config)
    {
        $def = $container->getDefinition('bloghoven.blosxom_dir_provider.entry_provider');
        $def->setArguments(array($config['data_dir']));
    }
}
