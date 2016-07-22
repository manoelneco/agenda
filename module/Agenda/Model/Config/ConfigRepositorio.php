<?php

namespace Agenda\Model\Config;

use Alpha\Repositorio\AbstractRepositorio;
use Zend\Db\Sql\Sql;
use Zend\XmlRpc\Value\ArrayValue;


class ConfigRepositorio extends AbstractRepositorio{
	
	protected $serviceManager;
	
	/**
	 * 
	 * @param SessionManager $serviceManager
	 */
	public function __construct($serviceManager){
		$this->serviceManager = $serviceManager;
		
		parent::__construct($serviceManager->get('Zend\Db\Adapter\Adapter'), 'config', new Config());
	}

	public function fetch(){
        $sql = new Sql( $this->adapter );
		
		$select = $sql->select( $this->table );

		return $this->selectWith($select)->current();
	}
	
}