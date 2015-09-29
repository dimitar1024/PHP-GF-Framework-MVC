<?php

namespace GF;


class FormViewHelper
{
    private static $_instance = null;
    private $_elements = array();
    private $_allElements = array();
    private $id = 0;
    private $_isInForm = false;
    protected $_TokenArray = array();

    private function  __construct()
    {

    }

    public static function init()
    {
        if (self::$_instance == null) {
            self::$_instance = new FormViewHelper();
        }

        return self::$_instance;
    }

    public function TextBox()
    {
        $this->_elements[$this->id]['open'] = '<input type="text"';
        $this->_elements[$this->id]['close'] = '>';

        return $this;
    }

    public function Form($action, $attributes = array(), $method = 'post')
    {
        if ($this->id != 0) {
            throw new \Exception('Cannot start form as not first element!', 500);
        }

        $this->_elements['formAttributes'] = $attributes;
        $this->_elements['form']['action'] = $action;
        $this->_elements['form']['method'] = $method;
        $this->_isInForm = true;
        if (strtolower($method) != 'post' && strtolower($method) != 'get') {
            $this->_TokenArray[$method] = '<input type="hidden" name="_method" value="' . $method . '">';
            $this->_elements['form']['method'] = "post";
        }

        return $this;
    }

    public function PasswordBox()
    {
        $this->_elements[$this->id]['open'] = '<input type="password"';
        $this->_elements[$this->id]['close'] = '>';

        return $this;
    }

    public function TextArea($value = '')
    {
        $this->_elements[$this->id]['open'] = '<textarea';
        $this->_elements[$this->id]['close'] = ">$value</textarea>";

        return $this;
    }

    public function UploadFile()
    {
        $this->_elements[$this->id]['open'] = '<input type="file"';
        $this->_elements[$this->id]['close'] = '>';

        return $this;
    }

    public function RadioBox()
    {
        $this->_elements[$this->id]['open'] = '<input type="radio"';
        $this->_elements[$this->id]['close'] = '>';

        return $this;
    }

    public function Submit()
    {
        $this->_elements[$this->id]['open'] = '<input type="submit"';
        $this->_elements[$this->id]['close'] = '>';

        return $this;
    }

    public function Label()
    {
        $this->_elements[$this->id]['open'] = '<label';
        $this->_elements[$this->id]['close'] = '</label>';

        return $this;
    }

    public function CheckBox()
    {
        $this->_elements[$this->id]['open'] = '<input type="checkbox"';
        $this->_elements[$this->id]['close'] = '>';

        return $this;
    }

    public function Link()
    {
        $this->_elements[$this->id]['open'] = '<a';
        $this->_elements[$this->id]['close'] = '</a>';

        return $this;
    }

    public function Div()
    {
        $this->_elements[$this->id]['open'] = '<div';
        $this->_elements[$this->id]['close'] = '</div>';

        return $this;
    }

    public function DropDown($value, $type)
    {
        $this->_elements[$this->id]['open'] = ' <' . $type . ' class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $value . ' <span class="caret"></span></a>
          <ul class="dropdown-menu">';
        $this->_elements[$this->id]['close'] = ' </ul></' . $type . '>';

        return $this;
    }

    public function DropDownLi($href, $value)
    {
        $this->_elements[$this->id]['attributes'][] = '<li><a href="' . $href . '">' . $value . '</a></li>';

        return $this;
    }

    public function setName($name)
    {
        $this->_elements[$this->id]['name'] = 'name="' . $name . '"';

        return $this;
    }

    public function setValue($value)
    {
        $this->_elements[$this->id]['value'] = '>' . $value;

        return $this;
    }

    public function setAttribute($attribute, $value)
    {
        $this->_elements[$this->id]['attributes'][] = $attribute . '="' . $value . '"';

        return $this;
    }

    public function setChecked()
    {
        $this->_elements[$this->id]['checked'] = 'checked';

        return $this;
    }

    public function create()
    {
        $element = $this->_elements[$this->id];
        $html = $element['open'];
        if ($element['name']) {
            $html .= ' ' . $element['name'];
        }

        if ($element['attributes']) {
            foreach ($element['attributes'] as $attribute) {
                $html .= ' ' . $attribute;
            }
        }

        if ($element['checked']) {
            $html .= ' ' . $element['checked'];
        }

        if ($element['value']) {
            $html .= ' ' . $element['value'];
        }

        $html .= $element['close'];

        $this->_allElements[$this->id] = $html;
        unset($this->_elements[$this->id]);
        $this->id++;

        return $this;
    }

    public function render($samePageToken = false)
    {
        if ($this->_isInForm) {
            $action = $this->_elements['form']['action'];
            $method = $this->_elements['form']['method'];
            echo '<form action="' . $action . '" method="' . $method . '"';
            $attributes = $this->_elements['formAttributes'];
			
			foreach ($attributes as $attribute => $value) {
                echo " " . $attribute . '="' . $value . '"';
            }

            echo '>';

        }

        foreach ($this->_allElements as $element) {
            echo $element;
        }

        if ($this->_isInForm) {
            Token::init()->render($samePageToken);
            if (count($this->_TokenArray) != 0) {
                foreach ($this->_TokenArray as $token) {
                    echo $token;
                }

            }
            echo '</form>';
        }

        $this->_elements = array();
        $this->id = 0;
        $this->_isInForm = false;
        $this->_allElements = array();
        $this->_TokenArray = array();
    }
}