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

Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
Router::connect('/register', array('controller' => 'users', 'action' => 'register'));
Router::connect('/activateUser/*', array('controller' => 'users', 'action' => 'activateUser'));
Router::connect('/resetPassword/*', array('controller' => 'users', 'action' => 'resetPassword'));
Router::connect('/menuentries/:action/*', array('controller' => 'menuentries'));
Router::connect('/pages/:action/*', array('controller' => 'pages'));
Router::connect('/containers/:action/*', array('controller' => 'containers'));
Router::connect('/layouts/:action/*', array('controller' => 'layouttypes'));
Router::connect('/content/:action/*', array('controller' => 'contents'));
Router::connect('/admin/plugins', array('controller' => 'plugins', 'action' => 'index'));
Router::connect('/admin/plugins/:action/*', array('controller' => 'plugins'));
Router::connect('/admin/users', array('controller' => 'users', 'action' => 'index'));
Router::connect('/admin/users/:action/*', array('controller' => 'users'));
Router::connect('/pluginviews/:action/*', array('controller' => 'pluginviews'));
Router::connect('/plugin/:plugin/:controller/:action/*');
CakePlugin::routes();
Router::connect('/*', array('controller' => 'pages', 'action' => 'display'));

