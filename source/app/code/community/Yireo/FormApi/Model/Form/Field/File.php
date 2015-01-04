<?php
/**
 * Yireo FormApi for Magento
 *
 * @package     Yireo_FormApi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_FormApi_Model_Form_Field_File extends Yireo_FormApi_Model_Form_Field_Abstract
{
    /**
     * @var array
     */
    protected $upload = array();

    /**
     * @var null
     */
    protected $destinationFile = null;

    /**
     * @return null
     */
    public function getPostValue()
    {
        // Definitions
        $destinationFolder = BP.DS.$this->getParam('folder', 'var/tmp');

        // Check for the previous value
        $currentValue = Mage::app()->getRequest()->getParam($this->getName().'_previous');
        if(!empty($currentValue)) {
            $currentValue = $destinationFolder.DS.basename($currentValue);
        }

        if(!isset($_FILES[$this->getName()])) {
            $this->clean(false);
            return $currentValue;
        }

        $this->upload = $_FILES[$this->getName()];
        if(!empty($this->upload['error'])) {
            $this->clean(false);
            return $currentValue;
        }


        if(!is_dir($destinationFolder)) @mkdir($destinationFolder);
        if(!is_dir($destinationFolder)) {
            Mage::helper('formapi')->log('Upload-folder does not exist', $destinationFolder);
            $this->clean(false);
            return $currentValue;
        }

        $this->destinationFile = $destinationFolder.DS.$this->upload['name'];
        if(copy($this->upload['tmp_name'], $this->destinationFile) == false) {
            Mage::helper('formapi')->log('Failed to copy file to upload-folder', $destinationFolder);
            $this->clean(false);
            return $currentValue;
        }

        if(!is_file($this->destinationFile)) {
            Mage::helper('formapi')->log('Upload-file disappeared', $this->destinationFile);
            $this->clean(false);
            return $currentValue;
        }

        return $this->destinationFile;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        // Use parent validation first
        $return = parent::validate();
        if($return == false) {
            $this->clean();
            return false;
        }

        // Return if there are no data
        if($this->getData('required') == 0 && empty($this->upload)) {
            return true;
        }

        // Check for empty uploads
        if(!empty($this->upload['error'])) {
            switch($this->upload['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $uploadError = 'Maximum file-size exceeded';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $uploadError = 'File was only partially uploaded';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                case UPLOAD_ERR_NO_TMP_DIR:
                    $uploadError = 'Failed to write to system';
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $uploadError = 'Upload was blocked';
                    break;
            }

            if(!empty($uploadError)) {
                $this->errors[] = $uploadError;
                $this->clean();
                return false;
            }
        }


        // Check if the file-extension is allowed
        $extensions = $this->getParam('extensions', 'jpg,jpeg,png,gif');
        $extensions = explode(',', $extensions);
        $extensionAllowed = false;
        foreach($extensions as $extension) {
            $extension = trim($extension);
            if(preg_match('/\.'.$extension.'$/i', $this->upload['name'])) {
                $extensionAllowed = true;
            }
        }
        if($extensionAllowed == false) {
            $this->errors[] = 'File-extension is not allowed';
            $this->clean();
            return false;
        }

        // Check for file-size
        $size = $this->getParam('size', (1024 * 1024 * 1024));
        if(preg_match('/([0-9]+)M/', $size, $match)) $size = $match[0] * 1024 * 1024;
        if(preg_match('/([0-9]+)K/', $size, $match)) $size = $match[0] * 1024;
        if($this->upload['size'] > $size) {
            $difference = $this->upload['size'] - $size;
            $this->errors[] = 'Maximum file-size exceeded with '.$difference.' bytes';
            $this->clean();
            return false;
        }

        return true;
    }

    /**
     *
     */
    public function clean($existing = true)
    {
        if(!isset($this->upload['tmp_name'])) {
            return false;
        }

        if(file_exists($this->upload['tmp_name'])) {
            @unlink($this->upload['tmp_name']);
        }

        if($existing == true) {
            if(file_exists($this->destinationFile)) {
                @unlink($this->destinationFile);
            }
        }

    }

    /**
     * @return string
     */
    public function getHtml()
    {
        // Construct the attributes
        $attributes = $this->getAttributes();
        $attributes['type'] = 'file';
        $attributes['id'] = $this->getData('id');
        $attributes['name'] = $this->getData('name');
        $attributes['size'] = $this->getData('size');

        // Construct the CSS-class
        $class = $this->getData('class');
        $class[] = 'input-text';
        $attributes['class'] = implode(' ', $class);

        if(is_file($this->getValue())) {
            $currentFile = array();
            $currentFile['file'] = $this->getValue();
            $currentFile['filename'] = basename($currentFile['file']);
            $currentFile['folder'] = str_replace(BP, '', dirname($currentFile['file'])).DS;
            $currentFile['url'] = $currentFile['folder'].$currentFile['filename'];
        } else {
            $currentFile = false;
        }

        // Prepare block output
        $this->setAttributes($attributes);
        $this->setCurrentFile($currentFile);
        return $this->getBlockHtml('formapi/field/file.phtml');
    }
}
