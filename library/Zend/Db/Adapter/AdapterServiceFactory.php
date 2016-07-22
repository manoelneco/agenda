<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Db\Adapter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdapterServiceFactory implements FactoryInterface
{
    /**
     * Create db adapter service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Adapter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $__config = array();    

        if( isset( $config['db'][ $_SERVER['HTTP_HOST'] ] ) ){
            $__config = $config['db'][ $_SERVER['HTTP_HOST'] ];            
        }else if( isset($config['db']['default']) ){
            $__config = $config['db']['default'];
        }else{
            $__config = $config['db'];
        }
        
        return new Adapter($__config);
    }
}
