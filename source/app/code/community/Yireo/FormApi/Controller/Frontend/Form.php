<?php
/**
 * Yireo FormApi
 *
 * @package     Yireo_FormApi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * FormApi controller for the frontend
 */
class Yireo_FormApi_Controller_Frontend_Form extends Mage_Core_Controller_Front_Action
{
    /**
     * Method to return the path to the XML-formfile
     *
     */
    protected function getFormXml()
    {
        return null;
    }

    /**
     * Method to return the form-object
     *
     * @return Yireo_FormApi_Model_Form
     */
    protected function getForm()
    {
        $form = Mage::getSingleton('formapi/form')->loadFile($this->getFormXml());
        return $form;
    }

    /**
     * Method to return a list of all the field-names
     *
     * @return bool
     */
    protected function getFieldNames()
    {
        $form = $this->getForm();
        $fieldNames = $form->getFieldNames();
        if(empty($fieldNames)) {
            Mage::getModel('core/session')->addError(Mage::helper('formapi')->__('Failed to load fieldnames: %s', $this->formXml));
            return false;
        }
        return $fieldNames;
    }

    /**
     * Method to validate this form
     *
     * @return bool
     */
    protected function validate()
    {
        $return = true;
        $form = $this->getForm();
        if($form->validate() == false) {
            foreach($form->getErrors() as $error) {
                Mage::getModel('core/session')->addError($error);
                $return = false;
            }
        }

        return $return;
    }
}
