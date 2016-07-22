
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
			'dsn'    => 'mysql:dbname=calendario_avo;host=localhost;port=3306',
			'username' => 'root',
			'password' => '123456',
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