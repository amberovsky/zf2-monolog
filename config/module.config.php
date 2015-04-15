<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 *
 * Module configuration
 */

return [
	'service_manager' => [
		'factories'	=> [
            'Amberovsky\\Monolog\\MonologFactory'	=> Amberovsky\Monolog\Service\MonologService::class
		]
	]
];
