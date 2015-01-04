<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Validator_Ipaddress extends Yireo_FormApi_Model_Form_Validator_Abstract
{
    public function validate($data)
    {
        if(strlen($data) < 7) {
            $this->errors[] = '%s can not be less than 7 characters';
            return false;
        }

        if(preg_match('/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$/i', $data) == false) {
            $this->errors[] = '%s is not a valid IP-address';
            return false;
        }

        return true;
    }

    public function getProperties()
    {
        return array(
            'class' => 'validate-ip',
        );
    }
}
