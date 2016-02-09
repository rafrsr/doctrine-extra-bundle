<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Rafrsr\DoctrineExtraBundle\RafrsrDoctrineExtraBundle;
use Rafrsr\DoctrineExtraBundle\Utils\ClassUtils;

/**
 * Read configuration
 */
class RafrsrDoctrineExtraExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('rafrsr.doctrine.encryptor', $config['encrypt']['encryptor']);
        $container->setParameter('rafrsr.doctrine.secret', $config['encrypt']['secret']);

        $configDir = __DIR__ . '/../Resources/config';
        $loader = new Loader\YamlFileLoader($container, new FileLocator($configDir));

        //find for .yml files and load automatically
        $finder = new Finder();
        $finder->files()->name('*.yml')->in($configDir);

        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $loader->load($file->getRelativePathname());
        }
    }

    /**
     * @inheritdoc
     */
    public function prepend(ContainerBuilder $container)
    {
        //TODO: support for only specific bundles
        $kernel = RafrsrDoctrineExtraBundle::getKernel();
        $types = [];
        foreach ($kernel->getBundles() as $bundle) {
            $DBALFolder = $bundle->getPath() . DIRECTORY_SEPARATOR . 'DBAL';
            if (file_exists($DBALFolder)) {
                $types = array_merge($types, $this->getDBALTypes($DBALFolder));
            }
        }

        $container->loadFromExtension(
            'doctrine',
            [
                'dbal' => [
                    'types' => $types
                ],
            ]
        );
    }

    /**
     * Get all DBAL types inside the $folder using the $namespace
     *
     * @param string $path The real path to the DBAL types directory
     *
     * @return array
     */
    protected function getDBALTypes($path)
    {
        //find for .php files and load automatically
        $finder = new Finder();
        $finder->files()->name('*.php')->in($path);

        $types = [];
        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $class = ClassUtils::getFileClassName($file->getRealPath());
            $reflectionClass = new \ReflectionClass($class);

            if ($reflectionClass->isSubclassOf('Doctrine\DBAL\Types\Type')
                && !$reflectionClass->isAbstract()
                && !$reflectionClass->isTrait()
            ) {
                $name = $reflectionClass->newInstanceWithoutConstructor()->getName();
                $types[$name] = $reflectionClass->getName();
            }
        }

        return $types;
    }
}
