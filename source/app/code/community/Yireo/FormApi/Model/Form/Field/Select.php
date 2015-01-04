<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_Select extends Yireo_FormApi_Model_Form_Field_Abstract
{
    public function getHtml()
    {
        $attributes = $this->getAttributes();
        $attributes['name'] = $this->getData('name');
        $attributes['id'] = $this->getData('id');
        $attributes['multiple'] = $this->getData('multiple');

        $class = $this->getData('class');
        $class[] = 'input-select';
        $attributes['class'] = implode(' ', $class);

        $value = $this->getData('value');

        $options = $this->getOptions();
        foreach($options as $optionId => $option) {

            if($value === $option['value']) {
                $option['selected'] = ' selected="selected"';
            } else {
                $option['selected'] = '';
            }

            $options[$optionId] = $option;
        }

        $this->setSelectOptions($options);
        $this->setAttributes($attributes);
        return $this->getBlockHtml('formapi/field/select.phtml');
    }
}