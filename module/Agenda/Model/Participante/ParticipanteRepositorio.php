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

    public function fetchByPlanilha($planilhaId){
        $sql = new Sql( $this->adapter );
		
		$select = $sql->select( $this->table );
		$select->where(array(
            'planilha_id' => $planilhaId
        ));

		return $this->selectWith($select)->toArray();
    }

    public function fetchCellByPanilha($planilhaId, $row, $col){
        $sql = new Sql( $this->adapter );
		
		$select = $sql->select( $this->table );
		$select->where(array(
            'planilha_id' => $planilhaId,
            'row' => $row,
            'col' => $col,
        ));

		return $this->selectWith($select)->current();
    }

    public function updateValue($cell){
        $_cell = $this->fetchCellByPanilha($cell->planilhaId, $cell->row, $cell->col);
        
        if($_cell == false){
            $this->insert(array(
                'planilha_id' => $cell->planilhaId,
                'row' => $cell->row,
                'col' => $cell->col,
                'value' => $cell->value,
            ));
        }else{
            $sql = new Sql( $this->adapter );
		    $stmt = null;

            if(strlen($cell->value) == 0){
                $stmt = $sql->delete( $this->table );
                
                $stmt->where(array(
                    'planilha_id' => $cell->planilhaId,
                    'row' => $cell->row,
                    'col' => $cell->col
                ));

            }else{
                $stmt = $sql->update( $this->table );
                $stmt->set(array(
                    'planilha_id' => $cell->planilhaId,
                    'row' => $cell->row,
                    'col' => $cell->col,
                    'value' => $cell->value,
                ));

                $stmt->where(array(
                    'planilha_id' => $cell->planilhaId,
                    'row' => $cell->row,
                    'col' => $cell->col
                ));

            }

             $sql->prepareStatementForSqlObject( $stmt )->execute();                
        }
    }

	public function fetchAll(){
        $sql = new Sql( $this->adapter );
		
		$select = $sql->select( $this->table );
		$select->order('nome');

		return $this->selectWith($select)->toArray();
	}
	
}