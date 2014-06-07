$form = new Varien_Data_Form();


$field = $fieldset->addField('store_id', 'multiselect', array(
'name'      => 'stores[]',
'label'     => Mage::helper('cms')->__('Store View'),
'title'     => Mage::helper('cms')->__('Store View'),
'required'  => true,
'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
'disabled'  => $isElementDisabled,
));
$renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
$field->setRenderer($renderer);