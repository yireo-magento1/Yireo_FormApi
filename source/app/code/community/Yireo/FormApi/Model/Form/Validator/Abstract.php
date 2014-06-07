<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Validator_Abstract extends Varien_Object
{
    protected $errors = array();

    public function validate($data)
    {
        return true;
    }

    public function getProperties()
    {
        return array();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}