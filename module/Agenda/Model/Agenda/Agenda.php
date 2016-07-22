<?php

namespace Agenda\Model\Agenda;

use Alpha\Model\AbstractModel;

class Agenda extends AbstractModel{

	public function exchangeArray(array $data)
	{
 		$this->id = isset($data['id']) ? $data['id'] : null;
 		$this->participanteId = isset($data['participante_id']) ? $data['participante_id'] : null;
		$this->dia = isset($data['dia']) ? $data['dia'] : null;
		$this->mes = isset($data['mes']) ? $data['mes'] : null;
		$this->periodo = isset($data['periodo']) ? $data['periodo'] : null;
	}	
	
}