<?php

namespace Market\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class PostForm extends Form
{

    private $categories;

    function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function buildForm()
    {
        $this->setAttribute('method', 'POST');

        $category = new Select('category');
        $category->setLabel('Category')
                ->setValueOptions(
                        array_combine($this->categories, $this->categories)
        );

        $title = new Text('title');
        $title->setLabel('Title')
                ->setAttributes(
                        array(
                            'size' => 60,
                            'maxLenth' => 128
                        )
        );

        $submit = new Submit('submit');
        $submit->setAttribute('value', 'Post');

        $this->add($category)
                ->add($title)
                ->add($submit);
    }

}
