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
 * Rule overview-block
 */
class Yireo_FormApi_Block_Adminhtml_Container extends Mage_Adminhtml_Block_Widget_Container
{
    /**
     * @var null
     */
    protected $form_xml = null;

    /**
     * @var null
     */
    protected $form_name = null;

    /**
     * @var array
     */
    protected $form_data = array();

    /**
     * Method to set the internal form-data
     *
     * @param $data
     */
    public function setFormData($data)
    {
        $this->form_data = $data;
    }

    /**
     * Method to get the internal form-data
     *
     * @return array
     */
    public function getFormData()
    {
        return $this->form_data;
    }

    /**
     * Method to get the form-name (@todo: or form-ID?)
     *
     */
    public function getFormName()
    {
        return $this->form_name;
    }

    /**
     * Method to get the form-object
     *
     * @return Yireo_FormApi_Model_Form
     */
    public function getForm()
    {
        $form = Mage::getModel('formapi/form')->loadFile($this->form_xml);
        $form->setFieldData($this->form_data);
        return $form;
    }

    /**
     * Return the save URL
     *
     * @return string
     */
    public function getSaveUrl()
    {
        return Mage::getModel('adminhtml/url')->getUrl('*/*/save');
    }

    /**
     * Return the apply URL
     *
     * @return string
     */
    public function getApplyUrl()
    {
        return Mage::getModel('adminhtml/url')->getUrl('*/*/apply');
    }

    /**
     * Return the delete URL
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return Mage::getModel('adminhtml/url')->getUrl('*/*/delete');
    }

    /**
     * Return the back URL
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $this->setChild('save_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                'label' => Mage::helper('core')->__('Save'),
                'onclick' => $this->form_name.'.submit();',
                'class' => 'save'
            ))
        );

        $this->setChild('apply_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                'label' => Mage::helper('core')->__('Save and Continue Edit'),
                'onclick' => 'formApiSaveAndContinueEdit(\''.$this->form_name.'\', \''.$this->getApplyUrl().'\');',
                'class' => 'save'
            ))
        );

        $this->setChild('delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                'label' => Mage::helper('core')->__('Delete'),
                'onclick' => 'formApiDelete(\''.$this->form_name.'\', \''.$this->getDeleteUrl().'\');',
                'class' => 'delete'
            ))
        );

        $this->setChild('back_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                'label' => Mage::helper('core')->__('Back'),
                'onclick' => 'setLocation(\''.$this->getBackUrl().'\')',
                'class' => 'back'
            ))
        );

        return parent::_toHtml();
    }
}
