<?php

namespace Market\Form;

use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class PostFilter extends InputFilter
{
    private $categories;

    function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function buildFilter()
    {
        $category = new Input('category');
        $category->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags')
                ->attachByName('StringToLower');

        $category->getValidatorChain()
                ->attachByName('InArray', array('haystack' => $this->categories));

        $title = new Input('title');
        $title->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        $titleRegex = new \Zend\Validator\Regex(array('pattern' => '/^[a-zA-Z0-9 ]*$/'));
        $titleRegex->setMessage('Somente números, letras ou espaço');

        $title->getValidatorChain()
                ->attach($titleRegex)
                ->attachByName('StringLength', array('min' => 1, 'max' => 128));

        $this->add($category);
        $this->add($title);
    }
}
