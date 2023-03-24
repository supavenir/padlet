<?php
use Ubiquity\controllers\Router;
use Ubiquity\events\EventsManager;
use Ubiquity\events\DAOEvents;
use Ubiquity\events\RestEvents;
use Ubiquity\contents\transformation\TransformersManager;

\Ubiquity\cache\CacheManager::startProd($config);
\Ubiquity\orm\DAO::start();
Router::startAll();
Router::addRoute("_default", "controllers\\IndexController");

\Ubiquity\security\data\EncryptionManager::start($config,\Ubiquity\security\data\Encryption::AES256);

EventsManager::addListener([DAOEvents::BEFORE_INSERT,RestEvents::BEFORE_UPDATE],function ($instance) {
    if ($instance instanceof \models\User) {
        $instance->setPassword(password_hash($instance->getPassword(), PASSWORD_DEFAULT));
    }
});

EventsManager::addListener([DAOEvents::BEFORE_UPDATE,DAOEvents::BEFORE_INSERT],fn($instance)=>TransformersManager::transformInstance($instance));

EventsManager::addListeners([
    DAOEvents::GET_ALL=>fn($instances)=>TransformersManager::transformInstances($instances,'reverse'),
    DAOEvents::GET_ONE=>fn($instance)=>TransformersManager::transformInstance($instance,'reverse')
]);
