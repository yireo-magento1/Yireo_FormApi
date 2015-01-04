<?php
/**
 * Yireo FormApi
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Controller_Adminhtml_Generic extends Mage_Adminhtml_Controller_Action
{
    /*
     * @var $overviewBlock Block showing the overview of all items
     */
    protected $overviewBlock = null;

    /*
     * @var $editBlock Block showing the edit-page for an item
     */
    protected $editBlock = null;

    /**
     * Overview page
     *
     * @access public
     * @param null
     * @return null
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
     * @access public
     * @param null
     * @return null
     */
    public function gridAction()
    {
        $this->indexAction();
    }

    /**
     * Edit page
     *
     * @access public
     * @param null
     * @return null
     */
    public function editAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock($this->editBlock))
            ->renderLayout();
    }

    /**
     * Apply action
     *
     * @access public
     * @param null
     * @return null
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
     * @access public
     * @param null
     * @return null
     */
    public function saveAction()
    {
        $this->storeAction();
        $this->_redirect('*/*/index');
    }

    /**
     * Store action
     *
     * @access public
     * @param null
     * @return null
     */
    public function storeAction()
    {
        Mage::getModel('adminhtml/session')->addNotice($this->__('Controller::storeAction is not implemented'));
        return 0;
    }

    /**
     * Delete action
     *
     * @access public
     * @param null
     * @return null
     */
    public function deleteAction()
    {
        Mage::getModel('adminhtml/session')->addNotice($this->__('Controller::deleteAction is not implemented'));

        // Redirect
        $this->_redirect('identificationrequired/admin/index');
    }
}
