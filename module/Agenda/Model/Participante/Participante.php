<?php

namespace Agenda\Model\Participante;

use Alpha\Model\AbstractModel;

class Participante extends AbstractModel{

	public function exchangeArray(array $data)
	{
 		$this->id = isset($data['id']) ? $data['id'] : null;
		$this->nome = isset($data['nome']) ? $data['nome'] : null;
		$this->photo = isset($data['photo']) ? $data['photo'] : null;
	}	
	
}