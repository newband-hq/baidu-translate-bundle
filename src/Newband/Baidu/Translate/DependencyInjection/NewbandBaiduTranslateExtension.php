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
        $container->setParameter('newband.baidu.translate.appid', $config['appid']);
        $container->setParameter('newband.baidu.translate.secretKey', $config['secretKey']);

        $clientDef = new DefinitionDecorator('newband.baidu.translate.client');
        $clientDef->replaceArgument(0, $config['appid']);
        $clientDef->replaceArgument(1, $config['secretKey']);

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