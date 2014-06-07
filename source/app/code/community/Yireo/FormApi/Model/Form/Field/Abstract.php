<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */


class Yireo_FormApi_Model_Form_Field_Abstract extends Varien_Object
{
    protected $errors = array();

    protected $options = array();

    protected $params = array();

    protected $validators = array();

    public function getData($key='', $index=null)
    {
        $data = parent::getData($key, $index);

        switch($key) {
            case 'type':
                if(empty($data)) $data = 'input';
                break;

            case 'id':
                if(empty($data)) $data = $this->getData('name');
                break;

            case 'value':
                if($data == null) {
                    $data = $this->getData('default');
                }
                break;

            case 'label':
                if(empty($data)) $data = ucfirst($this->getData('name'));
                if(!empty($data)) $data = Mage::helper('formapi')->__($data);
                break;

            case 'description':
                if(!empty($data)) $data = Mage::helper('formapi')->__($data);
                break;

            case 'class':
                if(empty($data)) $data = array();
                if(!is_array($data)) $data = array($data);
                break;

            case 'size':
                if(empty($data)) $data = 60;
                break;

            //case 'maxlength':
            //    if(empty($data)) $data = 255;
            //    break;
        }

        return $data;
    }

    public function getPostValue()
    {
        $value = Mage::app()->getRequest()->getParam($this->getName());
        $value = trim($value);
        return $value;
    }

    public function addValidator($validatorName)
    {
        if(!empty($validatorName)) {
            $validator = Mage::getModel('formapi/form_validator_'.$validatorName);
            if(!empty($validator)) {

                // Load the validator properties
                $properties = $validator->getProperties();
                if(!empty($properties)) {
                    foreach($properties as $propertyName => $propertyValue) {
                        $currentValue = $this->getData($propertyName);
                        if(!empty($currentValue) && is_array($currentValue) && is_string($propertyValue)) {
                            $currentValue[] = $propertyValue;
                            $propertyValue = $currentValue;
                        }
                        $this->setData($propertyName, $propertyValue);
                    }
                }

                // Add this validator to the validator-list
                $this->validators[] = $validator;

            } else {
                Mage::helper('formapi')->log('Failed to load validator', $validatorName);
            }
        }
    }

    public function addOption($value, $label)
    {
        if(!empty($label)) $label = Mage::helper('formapi')->__($label);
        $this->options[] = array('value' => $value, 'label' => $label);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function getAttributes()
    {
        $form = $this->getForm();
        if(!empty($form)) {
            $disable = $form->getFeature('disable');
            if($disable == 1 || $disable == true) {
                $this->attributes['disabled'] = 'disabled';
            }
        }

        return $this->attributes;
    }

    public function addParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getParam($name = null, $default = null)
    {
        if(isset($this->params[$name])) {
            return $this->params[$name];
        }
        return $default;
    }

    public function setParam($name = null, $value = null)
    {
        $this->params[$name] = $value;
    }

    public function validate()
    {
        $return = true;

        if(!empty($this->validators)) {
            foreach($this->validators as $validator) {
                if($validator->validate($this->getData('value')) == false) {
                    $validatorErrors = $validator->getErrors();
                    if(!empty($validatorErrors)) {
                        foreach($validatorErrors as $validatorError) {
                            if(!empty($validatorError)) {
                                $validatorError = Mage::helper('formapi')->__($validatorError, $this->getLabel());
                                $this->errors[] = $validatorError;
                            }
                        }
                    }
                    $return = false;
                }
            }
        }
        return $return;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getHtml()
    {
        return null;
    }

    public function getBlockHtml($template = null)
    {
        $arguments = array(
            'template' => $template,
            'field' => $this,
        );

        $block = Mage::app()->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'field_'.$this->getData('name'),
            $arguments
        );
        return $block->toHtml();
    }

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getForm()
    {
        return $this->form;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }
}
