<?php
App::uses('Xml', 'Utility');

class CMSPluginComponent extends Component
{

    function getPluginList()
    {
        $allPlugins = App::objects('plugins');
        $cmsPlugins = array();
        foreach ($allPlugins as $plugin) {
            if ($this->isCMSPlugin($plugin)) {
                $xml = Xml::build($this->getConfigPath($plugin));
                $xmlData = Xml::toArray($xml);

                $pluginData = $xmlData['dualon']['plugin'];

                $cmsPlugins[] = $pluginData;
            }
        }
        return $cmsPlugins;
    }

    function getVersion($plugin)
    {
        $xml = Xml::build($this->getConfigPath($plugin));
        $xmlData = Xml::toArray($xml);
        return $xmlData['dualon']['plugin']['version'];
    }

    function getAuthor($plugin)
    {
        $xml = Xml::build($this->getConfigPath($plugin));
        $xmlData = Xml::toArray($xml);
        return $xmlData['dualon']['plugin']['author'];
    }

    function getPermissions($plugin)
    {
        $xml = Xml::build($this->getConfigPath($plugin));
        $xmlData = Xml::toArray($xml);
        if (array_key_exists('permissions', $xmlData['dualon']['plugin'])) {
            $permissions = $xmlData['dualon']['plugin']['permissions'];
            if (array_key_exists('action', $permissions['permission'])) {
                $permissionsArray = array();
                $permissionsArray['permission'][0]['role'] = $permissions['permission']['role'];
                $permissionsArray['permission'][0]['action'] = $permissions['permission']['action'];
                $permissions = $permissionsArray;
            }
            return $permissions;
        } else {
            return null;
        }
    }

    function getViews($plugin)
    {
        $xml = Xml::build($this->getConfigPath($plugin));
        $xmlData = Xml::toArray($xml);
        if (array_key_exists('views', $xmlData['dualon']['plugin'])) {
            $views = $xmlData['dualon']['plugin']['views'];
            if (array_key_exists('name', $views['view'])) {
                $viewsArray = array();
                $viewsArray['view'][0]['name'] = $views['view']['name'];
                $views = $viewsArray;
            }
            return $views;
        } else {
            return null;
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
        if ($this->hasSchema($plugin)) {
            $schema = $this->initSchema($plugin);
            $db = ConnectionManager::getDataSource($schema->connection);
            $db->cacheSources = false;

            $installedTables = $db->listSources();
            $schemaTables = $schema->tables;

            $notFound = 0;

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