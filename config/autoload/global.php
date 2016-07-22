
<?php

/**
 * Configuração Global
 */

return array(
	
	/**
	 * Configuração de acesso ao banco de dados
	 */
	 
	 'db' => array(

	    'default' => array(
	    	'driver' => 'Pdo',
			'dsn'    => 'mysql:dbname=agenda_avo;host=agenda_avo.mysql.dbaas.com.br;port=3306',
			'username' => 'agenda_avo',
			'password' => 'agenda@mmx1',
	        'driver_options' => array(
	            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
	        )
		)
	),

	/**
	 * Configuração da classe de conexão com o banco
	 */
	'service_manager' => array(
		'factories' => array(
			'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
		)
	)
			
);