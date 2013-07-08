<?php

class BlueAcorn_Disabler_Model_Resource_DisabledSite extends Mage_Core_Model_Resource_Db_Abstract {
    protected function _construct() {
        $this->_init('disabler/disabledsite', 'disabledsite_id');
    }
}