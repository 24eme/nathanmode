<?php

/**
 * Description of ExportCsv
 *
 * @author vince
 */
class ExportCsv {

    /**
     *
     * @var string
     */
    protected $_content = null;
    protected $_filename = null;

    public function __construct($filename, $headers = null) {
        $this->_filename = $filename;
        if ($headers) {
            $this->add($headers, array());
        }
    }

    /**
     *
     * @param array $data
     * @param array $validation
     * @return string 
     */
    protected function implode($data, $validation) {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $validation)) {
                //$value = $this->cast($value, $validation[$key]['type']);
                $this->validate($key, $value, $validation[$key]);
                $data[$key] = $this->filter($value, $validation[$key]);
            } else {
                $data[$key] = $this->filterDefault($value);
            }
        }

        return implode(';', $data) . "\n";
    }

    protected function validate($key, $value, $options) {
        $type = $options['type'];
        $fn_type = "is_" . $type;
        if (!is_null($value) && !$fn_type($value) && $this->cast($value, $type) != $value) {
            throw new sfException("not " . $type . " : " . $value . " (" . $key . ")");
        }
        $this->cast($value, $type);
        if ($options['required'] && (!array_key_exists("default", $options) || $options['default'] === false)) {
            if ($value === null) {
                throw new sfException("required : ".$value." (".$key.")");
            }
        }
        return $value;
    }
    
    protected function cast($value, $type) {
        if ($value === null) {
           return $value;
        }
        if ($type == "string") {
           return (string) $value; 
        }
        if ($type == "int") {
           return (int) $value; 
        }
        if ($type == "double") {
           return (double) $value; 
        }
        if ($type == "float") {
           return (float) $value; 
        }
        return $value;
    }

    protected function filter($value, $options) {
        $type = $options['type'];
        if ($type == "string") {
            $value = '"' . str_replace('"', '\"', $value) . '"';
        }
        if ($type == "float" && ($value !== null || (array_key_exists("default", $options) && $options['default']))) {
            $value = sprintf($options['format'], $value);
        }
        return $value;
    }
    
    protected function filterDefault($value) {
        return '"' . str_replace('"', '\"', $value) . '"';
    }

    /**
     *
     * @param array $data 
     * @param array $validation
     * @return string
     */
    public function add($data, $validation = array()) {
        $line = $this->implode($data, $validation);
        $this->_content .= $line;
        return $line;
    }

    /**
     *
     * @return string 
     */
    public function output() {
        return mb_convert_encoding($this->_content, 'UTF-16LE', 'UTF-8');
    }
    
    /**
     *
     * @param sfResponse $response 
     */
    public function configureResponse(sfResponse $response) {
        $response->setContentType('application/csv');
        $response->setHttpHeader('Content-disposition', 'filename='.$this->_filename, true);
        $response->setHttpHeader('Pragma', 'o-cache', true);
        $response->setHttpHeader('Expires', '0', true);
    }
}
