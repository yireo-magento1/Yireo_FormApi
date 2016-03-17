<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Validator_Email extends Yireo_FormApi_Model_Form_Validator_Abstract
{
    public function validate($data)
    {
        if(preg_match('/^([a-zA-Z0-9\.\_\-]+)\@([a-zA-Z0-9\.\-]+)/i', $data) == false) {
            $this->errors[] = '%s is not a valid email-address';
            return false;
        }
        return true;
    }

    public function getProperties()
    {
        return array(
            'class' => 'validate-email',
        );
    }
}
