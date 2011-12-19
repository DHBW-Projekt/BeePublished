<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

Router::connect('/users/:action/*', array('controller' => 'users'));
Router::connect('/roles/:action/*', array('controller' => 'roles'));
Router::connect('/plugins/:action/*', array('controller' => 'plugins'));
Router::connect('/menuentries/:action/*', array('controller' => 'menuentries'));
Router::connect('/pages/:action/*', array('controller' => 'pages'));
Router::connect('/*', array('controller' => 'pages', 'action' => 'display'));
Router::connect('/admin/*', array('controller' => 'pages', 'action' => 'display'));

CakePlugin::routes();