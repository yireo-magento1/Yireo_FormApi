<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_Submit extends Yireo_FormApi_Model_Form_Field_Abstract
{
    public function getHtml()
    {
        $label = $this->getData('label');
        if (empty($label)) $label = Mage::helper('formapi')->__('Submit');

        $class = $this->getData('class');
        $class[] = 'button';
        $class = implode(' ', $class);

        $attributes = array(
            'label' => $label,
            'class' => $class,
        );

        $this->setAttributes($attributes);
        return $this->getBlockHtml('formapi/field/submit.phtml');
    }
}