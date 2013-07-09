<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Enterprise
 * @package     Enterprise_CustomerSegment
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

require_once('Enterprise/CustomerSegment/controllers/Adminhtml/CustomersegmentController.php');

/**
 * Customer segments grid and edit controller
 */
class BlueAcorn_Disabler_Adminhtml_CustomersegmentController extends Enterprise_CustomerSegment_Adminhtml_CustomersegmentController
{

    /**
     * Save disabled modules for this segment
     */
    public function saveAction() {
        $data = $this->getRequest()->getPost();

        if ($data) {
            try {
                $disabledModel = Mage::getModel('disabler/disabledmodule');
                $disabledModelCollection  = $disabledModel->getCollection()
                                                          ->addFieldToFilter('segment_id', $data['segment_id']);

                foreach ($disabledModelCollection as $item) {
                    $item->Delete();
                }

                if (array_key_exists('disabled_modules', $data)) {

                    foreach ($data['disabled_modules'] as $moduleName) {
                        $disabledModel->setDisabledmoduleId(null);
                        $disabledModel->setSegmentId($data['segment_id']);
                        $disabledModel->setModuleName($moduleName);
                        $disabledModel->Save();
                    }
                }

            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setPageData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('segment_id')));
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to save the segment.'));
                Mage::logException($e);
            }
        }

        parent::saveAction();
    }
}
