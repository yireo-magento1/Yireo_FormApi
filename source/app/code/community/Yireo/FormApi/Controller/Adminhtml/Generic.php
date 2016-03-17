<?php
/**
 * Yireo FormApi
 *
 * @package     Yireo_FormApi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Controller_Adminhtml_Generic extends Mage_Adminhtml_Controller_Action
{
    /**
     * @var $overviewBlock Block showing the overview of all items
     */
    protected $overviewBlock = null;

    /**
     * @var $editBlock Block showing the edit-page for an item
     */
    protected $editBlock = null;

    /**
     * Overview page
     *
     */
    public function indexAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock($this->overviewBlock))
            ->renderLayout();
    }

    /**
     * Alias for overview
     *
     */
    public function gridAction()
    {
        $this->indexAction();
    }

    /**
     * Edit page
     *
     */
    public function editAction()
    {
        $handle = 'formapi_edit';
        $this->getLayout()->getUpdate()->addHandle($handle);

        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock($this->editBlock))
            ->renderLayout();
    }

    /**
     * Apply action
     *
     */
    public function applyAction()
    {
        $id = $this->storeAction();
        if($id > 0) {
            $this->_redirect('*/*/edit', array('id' => $id));
        } else {
            $this->_redirect('*/*/index');
        }
    }

    /**
     * Save action
     *
     */
    public function saveAction()
    {
        $this->storeAction();
        $this->_redirect('*/*/index');
    }

    /**
     * Store action
     *
     */
    public function storeAction()
    {
        Mage::getModel('adminhtml/session')->addNotice($this->__('Controller::storeAction is not implemented'));
        return 0;
    }

    /**
     * Delete action
     *
     */
    public function deleteAction()
    {
        Mage::getModel('adminhtml/session')->addNotice($this->__('Controller::deleteAction is not implemented'));

        // Redirect
        $this->_redirect('adminhtml/identificationrequired/index');
    }
}
