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

Router::connect('/login', array('controller' => 'Users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'Users', 'action' => 'logout'));
Router::connect('/register', array('controller' => 'Users', 'action' => 'register'));
Router::connect('/activateUser/*', array('controller' => 'Users', 'action' => 'activateUser'));
Router::connect('/resetPassword/*', array('controller' => 'Users', 'action' => 'resetPassword'));
Router::connect('/menuentries/:action/*', array('controller' => 'MenuEntries'));
Router::connect('/pages/:action/*', array('controller' => 'Pages'));
Router::connect('/containers/:action/*', array('controller' => 'Containers'));
Router::connect('/layouts/:action/*', array('controller' => 'LayoutTypes'));
Router::connect('/content/:action/*', array('controller' => 'Contents'));
Router::connect('/users/:action/*', array('controller' => 'Users'));
Router::connect('/plugins/:action/*', array('controller' => 'Plugins'));
Router::connect('/plugins', array('controller' => 'Plugins', 'action' => 'index'));
Router::connect('/configuration', array('controller' => 'Configurations', 'action' => 'index'));
Router::connect('/email_templates', array('controller' => 'EmailTemplates', 'action' => 'index'));
Router::connect('/configuration/designs', array('controller' => 'Configurations', 'action' => 'designs'));
Router::connect('/permissions', array('controller' => 'Permissions', 'action' => 'index'));
Router::connect('/users', array('controller' => 'Users', 'action' => 'index'));
Router::connect('/pluginviews/:action/*', array('controller' => 'PluginViews'));
Router::connect('/plugin/:plugin/:controller/:action/*');
CakePlugin::routes();
Router::connect('/*', array('controller' => 'Pages', 'action' => 'display'));

