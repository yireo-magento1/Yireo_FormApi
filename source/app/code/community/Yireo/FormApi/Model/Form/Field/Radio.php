<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_Radio extends Yireo_FormApi_Model_Form_Field_Abstract
{
    public function getHtml()
    {
        $attributes = array();
        $attributes['type'] = 'radio';
        $attributes['name'] = $this->getData('name');

        $class = $this->getData('class');
        $class[] = 'input-radio';
        $attributes['class'] = implode(' ', $class);

        $value = $this->getData('value');
        $id = $this->getData('id');

        $options = $this->getOptions();

        foreach($options as $optionId => $option) {

            $option['id'] = $id.'-'.$option['value'];

            if($value === $option['value']) {
                $option['checked'] = ' checked="checked"';
            } else {
                $option['checked'] = '';
            }

            $options[$optionId] = $option;
        }


        $this->setRadioOptions($options);
        $this->setAttributes($attributes);
        return $this->getBlockHtml('formapi/field/radio.phtml');
    }
}