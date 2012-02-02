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
 * @description Receives CMS Plugin information
 */

App::uses('Xml', 'Utility');

class CMSPluginComponent extends Component
{

    function getPluginList()
    {
        //get list of all available plugins from cake
        $allPlugins = App::objects('plugins');
        $cmsPlugins = array();
        foreach ($allPlugins as $plugin) {
            //only add plugin to list if it is an CMS plugin
            if ($this->isCMSPlugin($plugin)) {
                //parse information cms
                $xml = Xml::build($this->getConfigPath($plugin));
                $xmlData = Xml::toArray($xml);

                $pluginData = $xmlData['dualon']['plugin'];

                $cmsPlugins[] = $pluginData;
            }
        }
        return $cmsPlugins;
    }

    //Get Plugin Version
    function getVersion($plugin)
    {
        $xml = Xml::build($this->getConfigPath($plugin));
        $xmlData = Xml::toArray($xml);
        return $xmlData['dualon']['plugin']['version'];
    }

    //Get Plugin Author
    function getAuthor($plugin)
    {
        $xml = Xml::build($this->getConfigPath($plugin));
        $xmlData = Xml::toArray($xml);
        return $xmlData['dualon']['plugin']['author'];
    }

    //Get plugin permissions
    function getPermissions($plugin)
    {
        $xml = Xml::build($this->getConfigPath($plugin));
        //Create array from XML structure
        $xmlData = Xml::toArray($xml);
        //only proceed if permissions really exist
        if (array_key_exists('permissions', $xmlData['dualon']['plugin'])) {
            $permissions = $xmlData['dualon']['plugin']['permissions'];
            if ($permissions == "") {
                return array();
            }
            if (!array_key_exists('permission', $permissions)){
            	return array();
            }
            if (array_key_exists('action', $permissions['permission'])) {
                $permissionsArray = array();
                $permissionsArray['permission'][0]['role'] = $permissions['permission']['role'];
                $permissionsArray['permission'][0]['action'] = $permissions['permission']['action'];
                $permissions = $permissionsArray;
            }
            return $permissions;
        } else {
            return array();
        }
    }

    //Get plugin views
    function getViews($plugin)
    {
        $xml = Xml::build($this->getConfigPath($plugin));
        //create array from plugin XML structure
        $xmlData = Xml::toArray($xml);
        //only proceed if view really exist
        if (array_key_exists('views', $xmlData['dualon']['plugin'])) {
            $views = $xmlData['dualon']['plugin']['views'];
            if ($views == "") {
                return array();
            }
            if (array_key_exists('name', $views['view'])) {
                $viewsArray = array();
                $viewsArray['view'][0]['name'] = $views['view']['name'];
                $views = $viewsArray;
            }
            return $views;
        } else {
            return array();
        }
    }


    function isCMSPlugin($plugin)
    {
        return file_exists($this->getConfigPath($plugin));
    }

    function hasSchema($plugin)
    {
        return file_exists($this->getSchemaPath($plugin));
    }

    function hasRouting($plugin)
    {
        return file_exists($this->getRoutingPath($plugin));
    }

    function getPath($plugin)
    {
        return CakePlugin::path($plugin);
    }

    function getConfigPath($plugin)
    {
        $path = CakePlugin::path($plugin);
        return $path . DS . 'Config' . DS . 'dualon_plugin_info.xml';
    }

    function getSchemaPath($plugin)
    {
        $path = CakePlugin::path($plugin);
        return $path . DS . 'Config' . DS . 'Schema' . DS . 'schema.php';
    }

    function getRoutingPath($plugin)
    {
        $path = CakePlugin::path($plugin);
        return $path . DS . 'Config' . DS . 'routes.php';
    }

    function getInstallStatus($plugin)
    {
        //If plugin has schema all tables have to be checked
        if ($this->hasSchema($plugin)) {
            $schema = $this->initSchema($plugin);
            $db = ConnectionManager::getDataSource($schema->connection);
            $db->cacheSources = false;

            //get installed tables
            $installedTables = $db->listSources();
            //get tables required by plugin
            $schemaTables = $schema->tables;

            $notFound = 0;

            //check each table if it exists
            foreach ($schemaTables as $schemaTable => $table) {
                if (!in_array($schemaTable, $installedTables)) {
                    $notFound++;
                }
            }

            if ($notFound == sizeof($schemaTables)) {
                return 1;
            } elseif ($notFound > 0) {
                return 2;
            }

            //compare current state with state required by plugin
            $installed = $schema->read(array('plugin' => $plugin));
            $compare = $schema->compare($installed, $schema);

            if (!empty($compare)) {
                return 2;
            } else {
                return 3;
            }
        }
    }

    function initSchema($plugin)
    {
        $schema = new CakeSchema(array('plugin' => $plugin, 'name' => $plugin));
        $schema = $schema->load(array('plugin' => $plugin, 'name' => $plugin));

        return $schema;
    }

    function executeSQL($contents, $db)
    {
        //for each table do required sql operations
        foreach ($contents as $table => $sql) {
            if (!empty($sql)) {
                $error = null;
                try {
                    $db->execute($sql);
                } catch (PDOException $e) {
                    $error = $table . ': ' . $e->getMessage();
                }
                if (!empty($error)) {
                    throw new CakeException($error);
                }
            }
        }
    }
}