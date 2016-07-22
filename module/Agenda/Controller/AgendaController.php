<?php

namespace Agenda\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Alpha\Wrapper\JsonWrapper;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\Session\Container;

use Agenda\Model\Participante\Participante;
use Agenda\Model\Participante\ParticipanteRepositorio;

use Agenda\Model\Agenda\Agenda;
use Agenda\Model\Agenda\AgendaRepositorio;

class AgendaController extends AbstractActionController {

    public function indexAction() {
        $participanteRepositorio = new ParticipanteRepositorio( $this->getServiceLocator() );

        return new ViewModel(array(
            'participantes' => $participanteRepositorio->fetchall()
        ));
    }

    public function allAction(){
        $agendaRepositorio = new AgendaRepositorio( $this->getServiceLocator() );

        header('Content-Type: application/json');

        return JsonWrapper::Ok( $agendaRepositorio->fetchAll() );
    }

    public function saveAction(){
        $agenda = json_decode( $this->getRequest()->getContent() );

        $agendaRepositorio = new AgendaRepositorio( $this->getServiceLocator() );

        $agendaRepositorio->save( $agenda );

        return JsonWrapper::Ok();
    }
       
}
