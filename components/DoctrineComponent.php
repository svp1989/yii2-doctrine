<?php

namespace yii\doctrine\components;

use Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Tools\Setup;
use yii\base\Component;
use yii\console\Exception;

class DoctrineComponent extends Component
{
    private $em    = null;
    private $isDev = false;
    private $basePath;
    private $proxyPath;
    private $entityPath;
    private $driver;
    private $user;
    private $password;
    private $host;
    private $dbname;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->setConfig($config);
    }

    private function setConfig(array $config)
    {
        if (empty($config)) {
            throw new Exception('Не удалось получить настройки Doctrine');
        }

        foreach ($config as $key => $value) {
            $method = 'set' . ucfirst($key);
            call_user_func([$this, $method], $value);
        }

    }

    public function init()
    {
        \Yii::setAlias('Doctrine', \Yii::getAlias('@app/vendor/Doctrine'));

        $conn = [
            'driver'   => $this->getDriver(),
            'user'     => $this->getUser(),
            'password' => $this->getPassword(),
            'host'     => $this->getHost(),
            'dbname'   => $this->getDbname()
        ];


        $config = Setup::createAnnotationMetadataConfiguration($this->entityPath, $this->getIsDev(), null, null, false);
        $entityManager = EntityManager::create($conn, $config);
        $this->setEntityManager($entityManager);
    }

    public function getEntityManager()
    {
        return $this->em;
    }

    public function setEntityManager($entityManager)
    {
        $this->em = $entityManager;
    }

    public function getIsDev()
    {
        return $this->isDev;
    }

    public function setIsDev($isDev)
    {
        $this->isDev = $isDev;
    }

    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    public function getBasePath()
    {
        return $this->basePath;
    }

    public function getProxyPath()
    {
        return $this->proxyPath;
    }

    public function setProxyPath($proxyPath)
    {
        $this->proxyPath = $proxyPath;
    }

    public function setEntityPath(array $entityPath)
    {
        $pathApp = dirname(\Yii::getAlias('@app')) . '/';

        foreach ($entityPath as $item) {
            $this->entityPath[] = $pathApp . $item;
        }
    }

    public function getEntityPath()
    {
        return $this->entityPath;
    }

    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setDbname($dbname)
    {
        $this->dbname = $dbname;
    }

    public function getDbname()
    {
        return $this->dbname;
    }

}