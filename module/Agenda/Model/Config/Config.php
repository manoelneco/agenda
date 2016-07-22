<?php

namespace Agenda\Model\Config;

use Alpha\Model\AbstractModel;

class Config extends AbstractModel{

	public function exchangeArray(array $data)
	{
 		$this->id = isset($data['id']) ? $data['id'] : null;
		$this->diaInicio = isset($data['dia_inicio']) ? $data['dia_inicio'] : null;
		$this->mesInicio = isset($data['mes_inicio']) ? $data['mes_inicio'] : null;
		$this->anoInicio = isset($data['ano_inicio']) ? $data['ano_inicio'] : null;
	}	
	
}