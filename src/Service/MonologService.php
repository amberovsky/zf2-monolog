<?php
/**
 * @author Anton Zagorskiy amberovsky@gmail.com
 */

namespace Amberovsky\Monolog\Service;

use Amberovsky\Monolog\MonologFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Monolog Service
 */
class MonologService implements FactoryInterface {

    /**
     * @param ServiceLocatorInterface $ServiceLocator
     *
     * @return MonologFactory
     */
    public function createService(ServiceLocatorInterface $ServiceLocator) {
        return new MonologFactory(isset($ServiceLocator->get('config')['123']) ? [] : []);
    }
}
