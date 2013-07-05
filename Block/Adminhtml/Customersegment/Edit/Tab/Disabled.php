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
        $model = Mage::registry('current_customer_segment');

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('segment_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => 'Disabled Modules'
        ));

        if ($model->getId()) {
            $fieldset->addField('segment_id', 'hidden', array(
                'name' => 'segment_id'
            ));
        }

        $module_names = array_keys((array)Mage::getConfig()->getNode('modules')->children());

        foreach ($module_names as $name) {
            $checkboxes[] = array('value' => $name, 'label' => $name);
        }

        $fieldset->addField('module_checkboxes', 'checkboxes', array(
            'label' => 'Modules to Disable',
            'name' => 'Checkbox',
            'values' => $checkboxes,
            'value' => '1',
            'disabled' => false,
            'after_element_html' => '<small>Don\'t pay any attention to this</small>',
            'tabindex' => 1
        ));



        if (!$model->getId()) {
            $model->setData('is_active', '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
