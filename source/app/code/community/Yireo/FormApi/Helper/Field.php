<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * FormApi helper
 */
class Yireo_FormApi_Helper_Field extends Mage_Core_Helper_Abstract
{
    public function toAttributeString($attributes)
    {
        $attributeStrings = array();
        foreach($attributes as $name => $value) {
            if($value !== null) {
                $attributeStrings[] = $name.'="'.$value.'"';
            }
        }

        return implode(' ', $attributeStrings);
    }
}
