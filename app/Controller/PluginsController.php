<?php
App::uses('AppController', 'Controller');
/**
 * Plugin Controller
 *
 */
class PluginsController extends AppController
{

    public $components = array('CMSPlugin');

    function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('index', 'install', 'uninstall');
    }

    function index()
    {
        $this->loadModel('CakeSchema');
        $plugins = $this->CMSPlugin->getPluginList();
        $this->set('plugins', $plugins);
    }

    function install($plugin)
    {
        $this->loadModel('CakeSchema');
        if (!$this->CMSPlugin->isCMSPlugin($plugin)) {
            throw new MissingPluginException(array('plugin' => $plugin));
        }
        if (!$this->CMSPlugin->hasSchema($plugin)) {
            throw new CakeException('Plugin has no schema file.');
        }

        $schema = $this->CMSPlugin->initSchema($plugin);
        $db = ConnectionManager::getDataSource($schema->connection);
        $db->cacheSources = false;

        try {
            $Old = $schema->read(array('plugin' => $plugin));
        } catch (Exception $e) {
            $Old = false;
        }

        $tables = $db->listSources();

        $compare = array();
        if ($Old) {
            $compare = $schema->compare($Old, $schema);
        }

        $contents = array();
        foreach ($schema->tables as $table => $data) {
            if (!in_array($table, $tables)) {
                $contents[$table] = $db->createSchema($schema, $table);
            } elseif (array_key_exists($table, $compare)) {
                $contents[$table] = $db->alterSchema(array($table => $compare[$table]), $table);
            }
        }

        $this->executeSQL($contents, $db);
        $this->Session->setFlash(__('Plugin tables are now up to date.'));
        $this->redirect(array('action' => 'index'));
    }

    function uninstall($plugin)
    {
        $this->loadModel('CakeSchema');
        if (!$this->CMSPlugin->isCMSPlugin($plugin)) {
            throw new MissingPluginException(array('plugin' => $plugin));
        }
        if (!$this->CMSPlugin->hasSchema($plugin)) {
            throw new CakeException('Plugin has no schema file.');
        }

        $schema = $this->CMSPlugin->initSchema($plugin);

        $db = ConnectionManager::getDataSource($schema->connection);
        $db->cacheSources = false;

        foreach ($schema->tables as $table => $fields) {
            $drop[$table] = $db->dropSchema($schema, $table);
        }

        $this->executeSQL($drop, $db);
        $this->Session->setFlash(__('Plugin successfully uninstalled.'));
        $this->redirect(array('action' => 'index'));
    }

    private function executeSQL($contents, $db)
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
