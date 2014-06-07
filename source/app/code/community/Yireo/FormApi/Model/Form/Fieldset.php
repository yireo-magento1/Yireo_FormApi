<?php
/**
 * Yireo FormApi
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Fieldset
{
    /**
     * @var null
     */
    protected $name = null;

    /*
    * Array of Yireo_FormApi_Model_Form_Field_* objects
    */
    /**
     * @var array
     */
    protected $fields = array();

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name = null)
    {
        if(!empty($name)) $this->name = (string)$name;
    }

    /**
     * @return null|string
     */
    public function getLabel()
    {
        if(!empty($this->label)) {
            return Mage::helper('formapi')->__($this->label);
        }

        if(!empty($this->name)) {
            return Mage::helper('formapi')->__(ucfirst($this->name));
        }

        return null;
    }

    /**
     * @param null $label
     */
    public function setLabel($label = null)
    {
        if(!empty($label)) $this->label = (string)$label;
    }

    /**
     * @param $fieldXml
     * @param $data
     * @return bool
     */
    public function addField($fieldXml, $data)
    {
        // Determine the field-type
        $type = $fieldXml['type'];
        if($type == 'text') $type = 'input';

        // Convert underscores to camel-case styles
        if(strstr($type, '_')) {
            $typeParts = explode('_', $type);
            $type = array_shift($typeParts);
            foreach($typeParts as $typePart) {
                $type .= ucfirst($typePart);
            }
        }

        // Determine the field-model
        if(!empty($fieldXml['model'])) {
            $model = $fieldXml['model'];
        } else {
            $model = 'formapi/form_field_'.$type;
        }

        // Initialize the field-model, with as fallback type "input"
        $field = Mage::getModel($model);
        // @todo: This throws a log-warning every time the model does not exists
        if(empty($field)) $field = Mage::getModel('formapi/form_field_input');

        // Add the form as back reference
        $field->setForm($this->getForm());

        // Load the XML-attributes into this object
        if($fieldXml->attributes()) {
            foreach($fieldXml->attributes() as $name => $value) {

                if($name == 'validation') {
                    $validators = explode(' ', $value);
                    if(!empty($validators)) {
                        foreach($validators as $validator) {
                            $field->addValidator($validator);
                        }
                    }

                } else {
                    $value = (string)$value;
                    $field->setData($name, $value);
                }
            }
        }

        // Load the XML-options into this object
        if($fieldXml->option) {
            foreach($fieldXml->option as $option) {
                $label = (string)$option;
                $value = (string)$option['value'];
                $field->addOption($value, $label);
            }
        }

        // Load the XML-parameters into this object
        if($fieldXml->param) {
            foreach($fieldXml->param as $param) {
                $name = (string)$param['name'];
                $value = (string)$param['value'];
                $field->addParam($name, $value);
            }
        }

        // Add some extra fields
        $field->setData('fieldset_name', $this->getName());

        $this->fields[] = $field;
        return true;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }
}
