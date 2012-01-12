<?php
App::uses('AppController', 'Controller');
/**
 * Plugin Controller
 *
 */
class PluginsController extends AppController
{
    public $components = array('CMSPlugin');
    public $uses = array('Plugin', 'Permission', 'Role', 'PluginView');

    function beforeFilter()
    {
        parent::beforeFilter();
        $role = $this->PermissionValidation->getUserRoleId();
        if ($role != 6 && $role != 7) {
            $this->redirect($this->request->webroot);
        }
    }

    function index()
    {
        $this->loadModel('CakeSchema');
        $installed = $this->Plugin->find('all');
        foreach ($installed as $idx => $plugin) {
            $plugin['status'] = $this->CMSPlugin->getInstallStatus($plugin['Plugin']['name']);
            $installed[$idx] = $plugin;
        }
        $available = $this->CMSPlugin->getPluginList();
        $this->set('installed', $installed);
        $this->set('available', $available);
        $this->set('systemPage', false);
        $this->set('adminMode', true);
        $this->set('menu', array());
    }

    function install($plugin)
    {
        $this->loadModel('CakeSchema');
        if (!$this->CMSPlugin->isCMSPlugin($plugin)) {
            throw new MissingPluginException(array('plugin' => $plugin));
        }

        $existingPlugin = $this->Plugin->find('first', array('conditions' => array('name' => $plugin)));

        $pluginObject = array(
            'name' => $plugin,
            'schema' => $this->CMSPlugin->hasSchema($plugin),
            'routing' => $this->CMSPlugin->hasRouting($plugin),
            'version' => $this->CMSPlugin->getVersion($plugin),
            'author' => $this->CMSPlugin->getAuthor($plugin)
        );

        if ($existingPlugin != null) {
            $pluginObject['id'] = $existingPlugin['Plugin']['id'];
        }

        $this->Plugin->save($pluginObject);

        if ($existingPlugin == null) {
            $pluginObject['id'] = $this->Plugin->id;
        }

        $permissions = $this->CMSPlugin->getPermissions($plugin);
        $permissionsInDB = $this->Permission->find('all', array('conditions' => array('plugin_id' => $pluginObject['id'])));
        $existingPermissions = array();
        foreach ($permissionsInDB as $permission) {
            $existingPermissions[] = $permission['Permission']['action'];
        }

        if ($permissions != null) {
            foreach ($permissions['permission'] as $permission) {
                if (in_array($permission['action'], $existingPermissions)) {
                    continue;
                }
                $role = $this->Role->findByName($permission['role']);
                $this->Permission->create();
                $permissionObject = array(
                    'plugin_id' => $pluginObject['id'],
                    'role_id' => $role['Role']['id'],
                    'action' => $permission['action']
                );
                $this->Permission->save($permissionObject);
            }
        }

        $views = $this->CMSPlugin->getViews($plugin);
        $viewsInDB = $this->PluginView->find('all', array('conditions' => array('plugin_id' => $pluginObject['id'])));
        $existingViews = array();
        foreach ($viewsInDB as $view) {
            $existingViews[] = $view['PluginView']['name'];
        }

        if ($views != null) {
            foreach ($views['view'] as $view) {
                if (in_array($view['name'], $existingViews)) {
                    continue;
                }
                $this->PluginView->create();
                $viewObject = array(
                    'plugin_id' => $pluginObject['id'],
                    'name' => $view['name']
                );
                $this->PluginView->save($viewObject);
            }
        }

        if ($this->CMSPlugin->hasSchema($plugin)) {
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

            $this->CMSPlugin->executeSQL($contents, $db);
        }

        $this->Session->setFlash(__('Plugin tables are now up to date.'));
        $this->redirect(array('action' => 'index'));
    }

    function uninstall($plugin)
    {
        $this->loadModel('CakeSchema');

        if (!$this->CMSPlugin->isCMSPlugin($plugin)) {
            throw new MissingPluginException(array('plugin' => $plugin));
        }

        $existingPlugin = $this->Plugin->find('first', array('conditions' => array('name' => $plugin)));
        if ($existingPlugin != null) {
            $this->Plugin->delete($existingPlugin['Plugin']['id']);
            $this->Permission->deleteAll(array('plugin_id' => $existingPlugin['Plugin']['id']));
            $this->PluginView->deleteAll(array('plugin_id' => $existingPlugin['Plugin']['id']));
        }


        if ($this->CMSPlugin->hasSchema($plugin)) {
            $schema = $this->CMSPlugin->initSchema($plugin);

            $db = ConnectionManager::getDataSource($schema->connection);
            $db->cacheSources = false;

            foreach ($schema->tables as $table => $fields) {
                $drop[$table] = $db->dropSchema($schema, $table);
            }

            $this->CMSPlugin->executeSQL($drop, $db);
        }


        $this->Session->setFlash(__('Plugin successfully uninstalled.'));
        $this->redirect(array('action' => 'index'));
    }

}
