<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_Store extends Yireo_FormApi_Model_Form_Field_Select
{
    /**
     * Template file of this form field
     *
     * @var string
     */
    protected $template = 'formapi/field/store.phtml';

    /**
     * Return the list of HTML attributes for this field
     *
     * @return mixed
     */
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        $attributes['multiple'] = 'multiple';
        $attributes['size'] = count($this->getOptions());

        return $attributes;
    }

    /**
     * Return the stores as field options array
     *
     * @return mixed
     */
    public function getOptions()
    {
        $options = Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true);
        return $options;
    }
}
