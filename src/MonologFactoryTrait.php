<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 */

namespace Amberovsky\Monolog;

use RuntimeException;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Выдача сервиса аутентификации
 */
trait MonologFactoryTrait {
	/** @var MonologFactory|null */
	protected $MonologFactory = null;

	/**
	 * Setter for monolog factory
	 *
	 * @param MonologFactory $MonologFactory
	 */
	public function setMonologFactory(MonologFactory $MonologFactory) {
		$this->MonologFactory = $MonologFactory;
	}

	/**
	 * @return MonologFactory
	 *
	 * @throws RuntimeException
	 */
	public function getMonologFactory() {
		if (is_null($this->MonologFactory)) {
			if (($this instanceof ServiceLocatorAwareInterface) || method_exists($this, 'getServiceLocator')) {
				$this->MonologFactory = $this->getServiceLocator()->get('Amberovsky\\Monolog\\MonologFactory');
			} elseif (
				property_exists($this, 'serviceLocator') &&
				($this->serviceLocator instanceof ServiceLocatorInterface)
			) {
				$this->MonologFactory = $this->serviceLocator->get('Amberovsky\\Monolog\\MonologFactory');
			} else {
				throw new RuntimeException('Service locator was not found');
			}
		}

		return $this->MonologFactory;
	}
}
