<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * FormApi helper
 */
class Yireo_FormApi_Helper_Content extends Mage_Core_Helper_Abstract
{
    public function getFileContents($file)
    {
        if(file_exists($file) == false) $file = Mage::getDesign()->getTemplateFilename($file);
        if(is_file($file) && is_readable($file)) {
            ob_start();
            include $file;
            $text = ob_get_contents();
            ob_end_clean();
            return $text;
        }
    }

    public function getCmspageContents($page)
    {
        if(preg_match('/^config:\/\/(.*)/', $page, $match)) {
            $config = $match[1];
            $page = Mage::getStoreConfig($match[1]);
        }

        $pageModel = Mage::getSingleton('cms/page')->setStoreId(Mage::app()->getStore()->getId())->load($page);
        if(!$pageModel->getPageId() > 0) {
            Mage::helper('formapi')->log('Failed to load CMS-page %s', $page);
            return null;
        }

        $helper = Mage::helper('cms');
        $processor = $helper->getPageTemplateProcessor();
        $html = $processor->filter($pageModel->getContent());
        return $html;
    }
}
