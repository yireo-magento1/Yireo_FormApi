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
    protected $template = 'formapi/field/select.phtml';

    public function getHtml()
    {
        $attributes = $this->getAttributes();
        $attributes['name'] = $this->getData('name');
        $attributes['id'] = $this->getData('id');
        $attributes['multiple'] = $this->getData('multiple');

        if((bool)$attributes['multiple']) {
            //$attributes['name'] = $attribute['name'][]; // @todo: Does not work yet
        }

        $class = $this->getData('class');
        $class[] = 'input-select';
        $attributes['class'] = implode(' ', $class);

        $value = $this->getData('value');

        $options = $this->getOptions();
        foreach($options as $optionId => $option) {
            $option = $this->matchOption($option, $value);
            $options[$optionId] = $option;
        }

        $this->setSelectOptions($options);
        $this->setAttributes($attributes);
        return $this->getBlockHtml($this->template);
    }

    protected function matchOption($option, $value)
    {
        if(is_array($option['value'])) {
            foreach($option['value'] as $suboptionIndex => $suboption) {
                $suboption = $this->matchOption($suboption, $value);
                $option['value'][$suboptionIndex] = $suboption;
            }
        }

        if(is_array($value) && in_array($option['value'], $value)) {
            $option['selected'] = ' selected="selected"';

        } elseif($value === $option['value']) {
            $option['selected'] = ' selected="selected"';

        } else {
            $option['selected'] = '';
        }

        return $option;
    }
}
