<?php
/**
 * Yireo ExtendedCustomer
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_CustomerEmail extends Yireo_FormApi_Model_Form_Field_Email
{
    public function getData($key='', $index=null)
    {
        $data = parent::getData($key, $index);

        if($key == 'value' && empty($data)) {
            $data = Mage::getModel('customer/session')->getCustomerEmail();
        }

        return $data;
    }
}
