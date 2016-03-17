<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_Checkbox extends Yireo_FormApi_Model_Form_Field_Abstract
{
    public function getHtml()
    {
        $attributes = array();
        $attributes['type'] = 'checkbox';
        $attributes['id'] = $this->getData('id');
        $attributes['name'] = $this->getData('name');
        $attributes['value'] = $this->getData('default');

        $id = $this->getData('id');
        $value = $this->getData('value');

        $class = $this->getData('class');
        $class[] = 'input-checkbox';
        $attributes['class'] = implode(' ', $class);

        if($value == $attributes['value']) $attributes['checked'] = 'checked';

        // Disable the normal field-description
        $this->setParam('show_description', 0);

        // Check for extra text-file
        $text = Mage::helper('formapi/content')->getFileContents($this->getParam('file'));
        if(!empty($text)) $this->setParam('text', $text);

        // Check for extra CMS-page
        $text = Mage::helper('formapi/content')->getCmspageContents($this->getParam('cmspage'));
        if(!empty($text)) $this->setParam('text', $text);

        $this->setAttributes($attributes);
        return $this->getBlockHtml('formapi/field/checkbox.phtml');
    }
}