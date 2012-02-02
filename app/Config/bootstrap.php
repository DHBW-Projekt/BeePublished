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
 * @description Basic CMS Settings
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

// Set default language
Configure::write('Config.language', 'de');

//Load CMS Plugins
CakePlugin::loadAll();
foreach (CakePlugin::loaded() as $plugin) {
    $path = CakePlugin::path($plugin) . 'Config' . DS . 'routes.php';
    if (file_exists($path)) {
        CakePlugin::unload($plugin);
        CakePlugin::load($plugin, array('routes' => true));
    }
}