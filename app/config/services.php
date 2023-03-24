<?php
use Ubiquity\controllers\Router;

\Ubiquity\cache\CacheManager::startProd($config);
\Ubiquity\orm\DAO::start();
Router::startAll();
Router::addRoute("_default", "controllers\\IndexController");

\Ubiquity\events\EventsManager::addListener(\Ubiquity\events\DAOEvents::BEFORE_INSERT, function ($instance) {
    if ($instance instanceof \models\User) {
        $instance->setPassword(password_hash($instance->getPassword(), PASSWORD_DEFAULT));
    }
});
\Ubiquity\security\data\EncryptionManager::start($config);
\Ubiquity\events\EventsManager::addListener(\Ubiquity\events\RestEvents::BEFORE_INSERT,function ($instance) {
	\Ubiquity\contents\transformation\TransformersManager::transformInstance($instance);
});
