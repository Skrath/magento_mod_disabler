<?php

class BlueAcorn_Disabler_Model_Observer {

    public function disableModules(Varien_Event_Observer $observer) {
        /* $this->_disableModule('BlueAcorn_Obvious'); */
        $segment_model = Mage::registry('current_customer_segment');

        $customerId = Mage::getSingleton('customer/session')->getCustomerId();
        $websiteId = Mage::app()->getStore()->getWebsiteId();

        // return segment array for this customer
        $segments = Mage::getModel('enterprise_customersegment/customer')->getCustomerSegmentIdsForWebsite($customerId,$websiteId);



        foreach ($segments as $segment) {
            $disabledModuleCollection = Mage::getModel('disabler/disabledmodule')->getCollection()
                                                                                 ->addFieldToFilter('segment_id', $segment);

            foreach ($disabledModuleCollection as $disabledModule) {
                $this->_disableModule($disabledModule->getModuleName());
            }

        }

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