<?php

class BlueAcorn_Disabler_Model_Resource_DisabledModule_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    protected function _construct() {
        $this->_init('disabler/disabledmodule');
    }
}