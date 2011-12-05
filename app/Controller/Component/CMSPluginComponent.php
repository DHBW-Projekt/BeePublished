<?php
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
                $pluginData['hasSchema'] = $this->hasSchema($plugin);
                $pluginData['status'] = $this->getInstallStatus($plugin);

                $cmsPlugins[] = $pluginData;
            }
        }
        return $cmsPlugins;
    }

    function isCMSPlugin($plugin)
    {
        return file_exists($this->getConfigPath($plugin));
    }

    function hasSchema($plugin)
    {
        return file_exists($this->getSchemaPath($plugin));
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

    function getInstallStatus($plugin)
    {
        if (!$this->hasSchema($plugin)) {
            return 0;
        }

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

    function initSchema($plugin)
    {
        $schema = new CakeSchema(array('plugin' => $plugin));
        $schema = $schema->load(array('plugin' => $plugin));

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