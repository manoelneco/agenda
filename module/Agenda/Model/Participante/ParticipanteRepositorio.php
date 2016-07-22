<?php

namespace Agenda\Model\Participante;

use Alpha\Repositorio\AbstractRepositorio;
use Zend\Db\Sql\Sql;
use Zend\XmlRpc\Value\ArrayValue;

use Agenda\Model\Participante\Participante;

class ParticipanteRepositorio extends AbstractRepositorio{
	
	protected $serviceManager;
	
	/**
	 * 
	 * @param SessionManager $serviceManager
	 */
	public function __construct($serviceManager){
		$this->serviceManager = $serviceManager;
		
		parent::__construct($serviceManager->get('Zend\Db\Adapter\Adapter'), 'participantes', new Participante());
	}

	public function fetchAll(){
        $sql = new Sql( $this->adapter );
		
		$select = $sql->select( $this->table );
		$select->order('nome');

		return $this->selectWith($select)->toArray();
	}
	
}