<?php

/**
 * Configuração do modulo
 */
return array(
	
	/**
	 * Configuração das rotas
	 */
	'router' => array(
		'routes' => array(
			
			'agenda' => array(
				'type' => 'Zend\Mvc\Router\Http\Segment',
				'options' => array(
					'route' => '/[:controller][/:action]',
					'defaults' => array(
						'controller' => 'agenda',
						'action' 	 => 'index'
					)
				)				
			)
				
		)
	),
		
	/**
	 * Configuração de alias das controllers
	 */
	'controllers' => array(
		'invokables' => array(
			'agenda' => 'Agenda\Controller\AgendaController',
		)
	),
		
	/**
	 * Configuração de JSON como retorno das actions
	 */
	'view_manager' => array(
		
		'template_map' => array(
			'layout/layout'           => __DIR__ . '/../View/layout.phtml'
		),
		
		'template_path_stack' => array(
			__DIR__ . '/../View',
		),
		
		'strategies' => array(
			'ViewJsonStrategy'
		)
	),
	
	/**
	 * Configuração da url base dos scripts
	 */
	 'static_files' => array(
		 /*'base_url' => 'http://cdn.investegoias.com.br'*/
		 'base_url' => ''
	 )
	
);