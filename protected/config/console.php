<?php

// This is the configuration for yiic console application.
return array(
 'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
 'name'=>'My Console Application',

     // autoloading model and component classes
 'import'=>array(
  'application.models.*',
  'application.components.*',
 ),

     // application components
 'components'=>array(

  'db'=>array(
   'connectionString' => 'mysql:host=127.0.0.1;dbname=google-proxy',
   'emulatePrepare' => true,
   'username' => 'root',
   'password' => '',
   'charset' => 'utf8',
   'tablePrefix'=>'tbl_',
  ),


 ),
);