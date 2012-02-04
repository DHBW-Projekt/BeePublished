<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Christoph Krämer
 *
 * @description Routing for BeePublished CMS
 */

Router::connect('/login', array('controller' => 'Users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'Users', 'action' => 'logout'));
Router::connect('/register', array('controller' => 'Users', 'action' => 'register'));
Router::connect('/activateUser/*', array('controller' => 'Users', 'action' => 'activateUser'));
Router::connect('/resetPassword/*', array('controller' => 'Users', 'action' => 'resetPassword'));
Router::connect('/changePassword/*', array('controller' => 'Users', 'action' => 'changePassword'));
Router::connect('/menuentries/:action/*', array('controller' => 'MenuEntries'));
Router::connect('/pages/:action/*', array('controller' => 'Pages'));
Router::connect('/containers/:action/*', array('controller' => 'Containers'));
Router::connect('/layouts/:action/*', array('controller' => 'LayoutTypes'));
Router::connect('/content/:action/*', array('controller' => 'Contents'));
Router::connect('/users/:action/*', array('controller' => 'Users'));
Router::connect('/emailtemplates/:action/*', array('controller' => 'EmailTemplates'));
Router::connect('/plugins/:action/*', array('controller' => 'Plugins'));
Router::connect('/plugins', array('controller' => 'Plugins', 'action' => 'index'));
Router::connect('/configuration', array('controller' => 'Configurations', 'action' => 'index'));
Router::connect('/emailtemplates', array('controller' => 'EmailTemplates', 'action' => 'index'));
Router::connect('/configuration/designs', array('controller' => 'Configurations', 'action' => 'designs'));
Router::connect('/permissions', array('controller' => 'Permissions', 'action' => 'index'));
Router::connect('/users', array('controller' => 'Users', 'action' => 'index'));
Router::connect('/pluginviews/:action/*', array('controller' => 'PluginViews'));
Router::connect('/plugin/:plugin/:controller/:action/*');
CakePlugin::routes();
Router::connect('/*', array('controller' => 'Pages', 'action' => 'display'));
