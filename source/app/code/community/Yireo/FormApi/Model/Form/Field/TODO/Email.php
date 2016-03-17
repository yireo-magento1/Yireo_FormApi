<?php
/**
 * Yireo ExtendedCustomer
 *
 * @package     Yireo_FormApi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_Email extends Yireo_FormApi_Model_Form_Field_Input
{
    protected $validators = array('email');
}