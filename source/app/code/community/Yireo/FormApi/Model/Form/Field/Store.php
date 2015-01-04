<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_Store extends Yireo_FormApi_Model_Form_Field_Select
{
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        $attributes['multiple'] = 'multiple';
        $attributes['size'] = count($this->getOptions()); // @todo: Calculate the right size of all stores

        return $attributes;
    }

    public function getOptions()
    {
        $options = Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true);
        return $options;
    }
}