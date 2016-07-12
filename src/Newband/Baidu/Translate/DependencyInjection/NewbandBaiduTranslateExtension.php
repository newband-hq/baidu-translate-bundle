<?php

namespace Newband\Baidu\Translate\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class NewbandBaiduTranslateExtension
 * @package Newband\Baidu\Translate\DependencyInjection
 * @author Zafar <zafar@newband.com>
 */
class NewbandBaiduTranslateExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('newband.baidu.translate.app', $config['app']);
        $container->setParameter('newband.baidu.translate.secret', $config['secret']);

        $clientDef = new DefinitionDecorator('newband.baidu.translate.client');
        $clientDef->replaceArgument(0, $config['app']);
        $clientDef->replaceArgument(1, $config['secret']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('client.xml');
        $loader->load('translator.xml');
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'newband_baidu_translate';
    }
}