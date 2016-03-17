<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * FormApi helper
 */
class Yireo_FormApi_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Helper-method to quickly log a debug-entry
     *
     * @param string $string
     * @param string $prefix
     *
     * @return string
     */
    public function stringtoMethod($string = null, $prefix = 'set')
    {
        if (empty($string) || is_numeric($string) || !strlen($string) > 2) {
            return false;
        }

        return $prefix . ucfirst($string);
    }

    /**
     * Helper-method to log something to the system-log
     *
     * @param string $string
     * @param mixed $mixed
     *
     */
    public function log($string, $mixed = null)
    {
        if ($mixed) {
            $string .= ': ' . var_export($mixed, true);
        }
        Mage::log('[FormApi]: ' . $string);
    }

    /**
     * Helper-method to quickly log a debug-entry
     *
     * @param string $string
     * @param mixed $mixed
     *
     */
    public function debug($string, $mixed = null)
    {
        if ($mixed) {
            $string .= ': ' . var_export($mixed, true);
        }
        file_put_contents('/tmp/formapi', '[FormApi]: ' . $string . "\n", FILE_APPEND);
    }
}
