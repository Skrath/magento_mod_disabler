<?php
/**
 * Disabled Modules tab of customer segment configuration
 *
 * @category    meh?
 * @package     BlueAcorn_Disabler
 * @author      Chris Rasys
 */
class BlueAcorn_Disabler_Block_Adminhtml_Customersegment_Edit_Tab_Disabled
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare general properties form
     *
     * @return Enterprise_CustomerSegment_Block_Adminhtml_Customersegment_Edit_Tab_General
     */
    protected function _prepareForm()
    {
        $segment_model = Mage::registry('current_customer_segment');

        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => 'Disabled Modules'
        ));

        $disabledModel = Mage::getModel('disabler/disabledmodule');
        $disabledModelCollection  = $disabledModel->getCollection()
                                                  ->addFieldToFilter('segment_id', $segment_model->getSegmentId());

        $savedModuleNames = array();
        foreach ($disabledModelCollection->getData() as $module) {
            $savedModuleNames[] = $module['module_name'];
        }

        $module_names = array_keys((array)Mage::getConfig()->getNode('modules')->children());

        foreach ($module_names as $name) {
            $checkboxes[] = array('value' => $name, 'label' => $name);
        }

        $fieldset->addField('module_checkboxes', 'checkboxes', array(
            'label' => 'Modules to Disable',
            'name' => 'disabled_modules[]',
            'values' => $checkboxes,
            'checked' => $savedModuleNames,
            'disabled' => false,
            'after_element_html' => '<small>Don\'t pay any attention to this</small>',
            'tabindex' => 1
        ));

        $this->setForm($form);

        return parent::_prepareForm();
    }
}
