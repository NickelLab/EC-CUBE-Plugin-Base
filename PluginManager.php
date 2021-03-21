<?php

namespace Plugin\Sample;

use Eccube\Plugin\AbstractPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Plugin\Sample\Entity\Config;

class PluginManager extends AbstractPluginManager
{
    protected $Container;
    protected $meta;
    protected $EntityManager;

    /**
     * initialize
     */
    protected function init(array $meta, ContainerInterface $container)
    {
        $this->container = $container;
        $this->meta = $meta;
        $this->EntityManager = $container->get('doctrine.orm.entity_manager');
    }

    public function enable(array $meta, ContainerInterface $container)
    {
        $this->init($meta, $container);
    }

    public function disable(array $meta, ContainerInterface $container)
    {
        $this->init($meta, $container);
    }

    public function install(array $meta, ContainerInterface $container)
    {
        $this->init($meta, $container);

        $this->createConfig();
    }

    public function uninstall(array $meta, ContainerInterface $container)
    {
        $this->init($meta, $container);
    }

    public function update(array $meta, ContainerInterface $container)
    {
        $this->init($meta, $container);
    }

    /**
     * Create Config Record
     * @return void
     */
    protected function createConfig()
    {
        $Config = $this->EntityManager->find(Config::class, 1);
        if(!$Config){
            $Config = new Config;
        }

        $Config->setName('sample');

        $this->EntityManager->persist($Config);
        $this->EntityManager->flush();
    }
}
