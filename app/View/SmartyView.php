<?php

class SmartyView extends View
{
    function __construct(&$controller)
    {
        parent::__construct($controller);

        if (is_object($controller)) {
            $count = count($this->__passedVars);
            for ($j = 0; $j < $count; $j++) {
                $var = $this->__passedVars[$j];
                $this->{$var} = $controller->{$var};
            }
        }

        if (!App::import('Vendor', 'Smarty', array('file' => 'smarty' . DS . 'Smarty.class.php')))
            die('error Loading Smarty Class');

        $this->Smarty = new Smarty();
        $this->subDir = 'smarty' . DS;

        /*
         * The extension to check, without it I can have smarty template and normal template
         * in the same project / controller
         */
        $this->ext = '.tpl';
        $this->Smarty->setPluginsDir(VENDORS . DS . 'smarty' . DS . 'plugins');
        $this->Smarty->setCompileDir(TMP . 'smarty' . DS . 'compile' . DS);
        $this->Smarty->setCacheDir(TMP . 'smarty' . DS . 'cache' . DS);
        $this->Smarty->error_reporting = 'E_ALL & ~E_NOTICE';
        $this->Smarty->debugging = true;
        $this->Smarty->compile_check = true;
        $this->viewVars['params'] = $this->params;
        $this->Helpers = new HelperCollection($this);
    }

    protected function _render($___viewFn, $___dataForView = array())
    {
        /*
        * I want that element will not use Smarty because they can have some php and developing
        * logic so I use this tree line to process it with the cake rendering. Probably it isn't
        * so nice but I don't know a better way
        */

        $trace = debug_backtrace();
        $caller = array_shift($trace);
        if ($caller === "element")
            parent::_render($___viewFn, $___dataForView);

        if (empty($___dataForView))
        {
            $___dataForView = $this->viewVars;
        }

        extract($___dataForView, EXTR_SKIP);

        foreach ($___dataForView as $data => $value)
        {
            if (!is_object($data))
            {
                $this->Smarty->assign($data, $value);
            }
        }

        /*
        * I do it to have the element method (I use it for example with this syntax:
        * {$View->element("sql_dump")} )
        */
        $this->Smarty->assign('View', new View(null));
        ob_start();

        $this->Smarty->display($___viewFn);

        return ob_get_clean();
    }

    /*
    * I pass the helper object to smarty so I can do: {$Html->link("link test", 'http://cakephp.org')}
    * or {$Session->flash()}
    */
    public function loadHelpers()
    {
        $helpers = HelperCollection::normalizeObjectArray($this->helpers);

        foreach ($helpers as $name => $properties)
        {
            list($plugin, $class) = pluginSplit($properties['class']);
            $this->{$class} = $this->Helpers->load($properties['class'], $properties['settings']);
            $this->Smarty->assign($name, $this->{$class});
        }
        
        $this->_helpersLoaded = true;
    }

}