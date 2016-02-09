<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('Rafrsr_doctrine_extra')->children();

        //encrypt
        $encrypt = $rootNode->arrayNode('encrypt')->addDefaultsIfNotSet()->children();
        $encrypt->scalarNode('secret')->defaultValue('%secret%');
        $encrypt->scalarNode('encryptor')->defaultValue(MCRYPT_RIJNDAEL_256);

        //dbal
        $dbal = $rootNode->arrayNode('dbal')->addDefaultsIfNotSet()->children();

        $types = $dbal->arrayNode('types')->addDefaultsIfNotSet()->children();
        $types->booleanNode('autoload')->defaultValue(false)
            ->info('Load automatically all dbal types created on all registered bundles.');

        return $treeBuilder;
    }
}
