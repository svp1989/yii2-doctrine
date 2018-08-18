<?php

namespace yii\doctrine\console;

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use yii\console\Controller;

class DoctrineController extends Controller
{
    public $option;

    public function actionIndex()
    {
        $this->env();
        \Yii::setAlias('Symfony', \Yii::getAlias('@app/vendor/Symfony'));

        $entityManager = \Yii::$app->doctrine->getEntityManager();
        $helperSet = ConsoleRunner::createHelperSet($entityManager);

        ConsoleRunner::run($helperSet, []);
    }

    public function options($actionID)
    {
        return ['option'];
    }

    public function optionAliases()
    {
        return ['o' => 'option'];
    }

    
    private function env()
    {
        $args = $_SERVER['argv'];

        unset ($args[0]);
        unset($_SERVER['argv']);

        foreach ($args as $arg) {
            $_SERVER['argv'][] = $arg;
        }

        if (isset($this->option)) {
            $_SERVER['argv'][2] =  str_replace('-o=','' , $_SERVER['argv'][2]);
        }
    }
}
