<?php

namespace Agenda\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Alpha\Wrapper\JsonWrapper;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\Session\Container;

use Agenda\Model\Participante\Participante;
use Agenda\Model\Participante\ParticipanteRepositorio;

class AgendaController extends AbstractActionController {

    public function indexAction() {
        $participanteRepositorio = new ParticipanteRepositorio( $this->getServiceLocator() );

        return new ViewModel(array(
            'participantes' => $participanteRepositorio->fetchall()
        ));
    }
       
}
