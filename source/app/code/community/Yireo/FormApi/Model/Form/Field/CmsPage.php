<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_CmsPage extends Yireo_FormApi_Model_Form_Field_Select
{
    public function getOptions()
    {
        $options = array();
        $pages = Mage::getModel('cms/page')->getCollection();
        foreach($pages as $page) {
            $options[] = array(
                'value' => $page->getId(),
                'label' => $page->getTitle(),
            );
        }

        return $options;
    }
}