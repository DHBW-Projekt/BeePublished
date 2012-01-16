<?php

class ConfigComponent extends Component
{

    public function getValue($key)
    {
        $this->Configuration = ClassRegistry::init('Configuration');
        $config = $this->Configuration->find('first');
        if (!array_key_exists($key,$config['Configuration'])) {
            return __('invalid key');
        } else {
            return $config['Configuration'][$key];
        }
    }

}
