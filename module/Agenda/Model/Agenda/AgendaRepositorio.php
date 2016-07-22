<?php

namespace Agenda\Model\Agenda;

use Alpha\Repositorio\AbstractRepositorio;
use Zend\Db\Sql\Sql;
use Zend\XmlRpc\Value\ArrayValue;

use Agenda\Model\Participante\Participante;
use Agenda\Model\Participante\ParticipanteRepositorio;

use Agenda\Model\Agenda\Agenda;

class AgendaRepositorio extends AbstractRepositorio{
	
	protected $serviceManager;
	
	/**
	 * 
	 * @param SessionManager $serviceManager
	 */
	public function __construct($serviceManager){
		$this->serviceManager = $serviceManager;
		
		parent::__construct($serviceManager->get('Zend\Db\Adapter\Adapter'), 'agendas', new Agenda());
	}

    public function fetchByDia($dia, $mes, $periodo){
        $sql = new Sql( $this->adapter );
		
		$select = $sql->select( $this->table );
		$select->where(array(
            'dia' => $dia,
            'mes' => $mes,
            'periodo' => $periodo,
        ));

		return $this->selectWith($select)->current();
    }

    public function save($agenda){
        $_agenda = $this->fetchByDia($agenda->dia, $agenda->mes, $agenda->periodo);
        
        if($_agenda == false){
            $this->insert(array(
                'dia' => $agenda->dia,
                'mes' => $agenda->mes,
                'ano' => $agenda->ano,
                'periodo' => $agenda->periodo,
                'participante_id' => $agenda->participanteId,
            ));
        }else{
            $sql = new Sql( $this->adapter );
		    $stmt = null;

            $stmt = $sql->update( $this->table );
            $stmt->set(array(
                'dia' => $agenda->dia,
                'mes' => $agenda->mes,
                'periodo' => $agenda->periodo,
                'ano' => $agenda->ano,
                'participante_id' => $agenda->participanteId,
            ));

            $stmt->where(array(
                'dia' => $_agenda->dia,
                'mes' => $_agenda->mes,
                'periodo' => $_agenda->periodo,
                'participante_id' => $_agenda->participanteId,
            ));

            $sql->prepareStatementForSqlObject( $stmt )->execute();                
        }
    }

	public function fetchAll(){
        $sql = new Sql( $this->adapter );
		
		$select = $sql->select( $this->table );
        $resultset = $this->selectWith($select)->toArray();

        $participanteRepositorio = new ParticipanteRepositorio( $this->serviceManager );

        foreach($resultset as $i => &$result){
            $result['participante'] = $participanteRepositorio->fetch( $result['participanteId'] );
        }

		return $resultset;
	}
	
}