<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_Input extends Yireo_FormApi_Model_Form_Field_Abstract
{
    public function getHtml()
    {
        // Construct the attributes
        $attributes = $this->getAttributes();
        $attributes['type'] = $this->getData('type');
        $attributes['id'] = $this->getData('id');
        $attributes['name'] = $this->getData('name');
        $attributes['value'] = $this->getData('value');
        $attributes['placeholder'] = $this->getData('placeholder');
        $attributes['maxlength'] = $this->getData('maxlength');
        $attributes['size'] = $this->getData('size');

        // Construct the CSS-class
        $class = $this->getData('class');
        $class[] = 'input-text';
        $attributes['class'] = implode(' ', $class);

        // Prepare block output
        $this->setAttributes($attributes);
        return $this->getBlockHtml('formapi/field/input.phtml');
    }
}