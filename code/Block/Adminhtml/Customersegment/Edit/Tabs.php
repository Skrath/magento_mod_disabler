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

class BlueAcorn_Disabler_Block_Adminhtml_Customersegment_Edit_Tabs extends Enterprise_CustomerSegment_Block_Adminhtml_Customersegment_Edit_Tabs
{

    /**
     * Add tab sections
     *
     * @return Enterprise_CustomerSegment_Block_Adminhtml_Customersegment_Edit_Tabs
     */
    protected function _beforeToHtml()
    {
        $disabledSectionContent = $this->getLayout()
                                       ->createBlock('blueacorn_disabler/adminhtml_customersegment_edit_tab_disabled')
                                      ->toHtml();



        $this->addTabAfter('disabled_modules_tab', array(
            'label' => "Disabled Modules",
            'title' => "Disabled Modules",
            'content' => $disabledSectionContent,
            'active' => true
        ), 'customers_tab');

        return parent::_beforeToHtml();
    }

}