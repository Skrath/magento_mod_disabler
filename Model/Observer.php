<?php

class BlueAcorn_Disabler_Model_Observer {

        public function disableModules(Varien_Event_Observer $observer) {
            /* $this->_disableModule('BlueAcorn_Obvious'); */
        }

        protected function _disableModule($moduleName) {
            // Disable the module itself
            $nodePath = "modules/$moduleName/active";
            if (Mage::helper('core/data')->isModuleEnabled($moduleName)) {
                Mage::getConfig()->setNode($nodePath, 'false', true);
            }

            // Disable its output as well (which was already loaded)
            $outputPath = "advanced/modules_disable_output/$moduleName";
            if (!Mage::getStoreConfig($outputPath)) {
                Mage::app()->getStore()->setConfig($outputPath, true);
            }
        }

}