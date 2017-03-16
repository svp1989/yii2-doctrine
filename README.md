# yii2-doctrine
Yii 2 extension wrapper to communicate with Doctrine 2.
## Installation
You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

    composer require svp/yii2-doctrine
    
## Usage ##
For connecting doctrine components insert in you **config** file
 ```php
'components' => [
...
        'doctrine'  => [
             'class'    => 'yii\doctrine\components\DoctrineComponent',
             'isDev'    => true,            //for development 
             'driver'   => 'pdo_mysql',     //database driver
             'user'     => 'user',          //database user
             'password' => 'password',      //password
             'host'     => 'localhost',     
             'dbname'   => 'dbname',        //name database
             'entityPath' => [              //paths with you entity
                 'backend/models',
                 'frontend/models',
                 'console/models',
                 'common/models',
             ]
         ]
]
 ```

For using doctrine console add to you **config** file 
```PHP
'controllerMap' => [
        ....
        'doctrine' => [
            'class'     => 'yii\doctrine\console\DoctrineController',
        ]
    ]
]
```
and call **./yii doctrine**, if you need transfer option use option -o=option.<br>
For example : <br>
    --_create_ table from entity **./yii orm:schema-tool:create** <br>
    --_update_ table from entity **./yii orm:schema-tool:update -o=--force** <br>
    --_create_ table from entity **./yii orm:schema-tool:drop -o=--dump-sql** etc.

