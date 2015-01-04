<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Helper_Template
{
    /**
     * Method to get a form-block
     *
     * @param $form Yireo_FormApi_Model_Form
     * @param $fieldData array
     * @param $template string
     * @return string
     */
    public function getFormBlock($form = null, $fieldData = array(), $template = null)
    {
        if(empty($template)) $template = 'formapi/form.phtml';
        $arguments = array(
            'template' => $template,
            'form' => $form,
            'field_data' => $fieldData,
        );
        return $this->_getBlock('form', $arguments);
    }

    /**
     * Method to get a fieldset-block
     *
     * @param $fieldset Yireo_FormApi_Model_Form_Fieldset
     * @param $template string
     * @return string
     */
    public function getFieldsetBlock($fieldset = null, $template = null)
    {
        if(empty($template)) $template = 'formapi/fieldset.phtml';
        $arguments = array(
            'template' => $template,
            'fieldset' => $fieldset,
        );
        return $this->_getBlock('fieldset', $arguments);
    }

    /**
     * Method to get a field-block
     *
     * @param $field Yireo_FormApi_Model_Form_Field_Abstract
     * @param $template string
     * @return string
     */
    public function getFieldBlock($field = null, $template = null)
    {
        if(empty($template)) $template = 'formapi/field.phtml';
        $arguments = array(
            'template' => $template,
            'field' => $field,
        );
        return $this->_getBlock('field', $arguments);
    }

    /**
     * Method to return block-output of a specific block
     *
     * @param $identifier string
     * @param $arguments array
     * @return string
     */
    public function _getBlock($identifier = null, $arguments = array())
    {
        if(Mage::app()->getStore()->isAdmin() == true) {
            $blockType = 'Mage_Adminhtml_Block_Template';
        } else {
            $blockType = 'Mage_Core_Block_Template';
        }

        $block = Mage::app()->getLayout()->createBlock($blockType, $identifier, $arguments);
        return $block->toHtml();
    }
}