<?php

class ImageVerification {
    private $photo;

    private $dimensions;

    private $maxWidth = 150;
    private $maxHeight = 180;
    private $maxSize = 5000;

    public $verifyWidth = true;
    public $verifyHeight = true;
    public $verifySize = true;

    public function __construct($photo) {
        $this->photo = $photo;
    }

    public function runVerifications() {
        $errors = array();

        if ($this->_isEmptyVerification()) {
            array_push($errors, "Error: image file is empty");
        }

        $this->_settingsDimensions();

        if (!$this->_isFileExtensionSupported()) {
            array_push($errors, "Error: image file extension is not supported");
        }

        if ($this->verifyWidth) {
            if (!$this->_checkWidth()) {
                array_push($errors, "Error: image width is greater than supported: max '$this->maxWidth'px");
            }
        }

        if ($this->verifyHeight) {
            if (!$this->_checkHeight()) {
                array_push($errors, "Error: image height is greater than supported: max '$this->maxHeight'px");
            }
        }

        if ($this->verifySize) {
            if (!$this->_checkSize()) {
                array_push($errors, "Error: image size is greater than supported: max '$this->maxSize'bytes");
            }
        }

        return $errors;
    }

    private function _isEmptyVerification() {
        if (!empty($this->photo['name'])) {
            return False;
        } else {
            return True;
        }
    } 

    private function _settingsDimensions() {
        $this->dimensions = getImageSize($this->photo['tmp_name']);
    }

    private function _isFileExtensionSupported() {
        if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/",$this->photo['type'])){
            return False;
        } else {                
            return True;
        }
    }

    private function _checkWidth() {
        if($this->dimensions[0] > $this->maxWidth) {
            return False;
        } else {
            return True;
        }
    }

    private function _checkHeight() {
        if($this->dimensions[1] > $this->maxHeight) {
            return False;
        } else {
            return True;
        }
    }

    private function _checkSize() {
        if($this->photo['size'] > $this->maxSize) {
            return False;
        } else {
            return True;
        }
    }
}

?>