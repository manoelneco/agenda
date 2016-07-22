<?php

namespace Alpha\Repositorio;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Adapter implements FactoryInterface{
	
	/**
     * Create db adapter service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Adapter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        var_dump($config['db']);
        die;
        return new Adapter($config['db']);
    }

}


?>