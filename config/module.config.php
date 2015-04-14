<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 *
 * Module configuration
 */

return [
	'service_manager' => [
		'factories'	=> [
            'MonologFactory'    => Amberovsky\Monolog\Service\MonologService::class
		]
	]
];
