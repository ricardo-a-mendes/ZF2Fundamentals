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

        //---------------------------------------------------------------------------------------------------
        $title = new Input('title');
        $title->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        $basicRegex = new \Zend\Validator\Regex(array('pattern' => '/^[a-zA-Z0-9 ]*$/'));
        $basicRegex->setMessage('Somente números, letras ou espaço');

        $title->getValidatorChain()
                ->attach($basicRegex)
                ->attachByName('StringLength', array('min' => 1, 'max' => 128));

        //---------------------------------------------------------------------------------------------------
        $dateExpiresValidation = new \Zend\Validator\Date(array(
            'format' => 'Y-m-d'
        ));
        $dateExpiresValidation->setMessage('Invalid Date Format!');
        $dateExpires = new Input('date_expires');
        $dateExpires->getValidatorChain()
                ->attach($dateExpiresValidation);

        //---------------------------------------------------------------------------------------------------
        $description = new Input('description');
        $description->getValidatorChain()
                ->attach($basicRegex)
                ->attachByName('StringLength', array('min' => 1, 'max' => 4096));

        $description->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        //---------------------------------------------------------------------------------------------------

        //URL Regex:
        $urlRegex = new \Zend\Validator\Regex(array('pattern' => '!^(http://)?[a-z0-9./_-]+(jp(e)?g|png)$!i'));
        $urlRegex->setMessage('URL inválida');

        $photoFilename = new Input('photo_filename');
        $photoFilename->getValidatorChain()
                ->attach($urlRegex)
                ->attachByName('StringLength', array('min' => 1, 'max' => 1024));

        $photoFilename->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        //---------------------------------------------------------------------------------------------------
        $contactName = new Input('contact_name');
        $contactName->getValidatorChain()
                ->attach($basicRegex)
                ->attachByName('StringLength', array('min' => 1, 'max' => 255));

        $contactName->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        //---------------------------------------------------------------------------------------------------
        $contactEmail = new Input('contact_email');
        $contactEmail->getValidatorChain()
                ->attach(new \Zend\Validator\EmailAddress(array('domain' => false)));

        $contactEmail->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        //---------------------------------------------------------------------------------------------------
        $contactPhone = new Input('contact_phone');
        $contactPhone->getValidatorChain()
                ->attach($basicRegex)
                ->attachByName('StringLength', array('min' => 1, 'max' => 32));

        $contactPhone->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        //---------------------------------------------------------------------------------------------------
        $city = new Input('city');
        $city->getValidatorChain()
                ->attach($basicRegex)
                ->attachByName('StringLength', array('min' => 1, 'max' => 128));

        $city->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        //---------------------------------------------------------------------------------------------------
        $contry = new Input('country');
        $contry->getValidatorChain()
                ->attach($basicRegex)
                ->attachByName('StringLength', array('min' => 1, 'max' => 2));

        $contry->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        //---------------------------------------------------------------------------------------------------
        $priceRegex = new \Zend\Validator\Regex(array('pattern' => '/[\d,\.]/'));
        $priceRegex->setMessage('Somente números');
        $price = new Input('price');
        $price->getValidatorChain()
                ->attach($priceRegex)
                ->attachByName('StringLength', array('min' => 1, 'max' => 13));

        $price->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        //---------------------------------------------------------------------------------------------------
        $deleteCode = new Input('delete_code');
        $deleteCode->getValidatorChain()
                ->attach($basicRegex);

        $deleteCode->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        //---------------------------------------------------------------------------------------------------
        $this->add($category);
        $this->add($title);
        $this->add($dateExpires);
        $this->add($description);
        $this->add($photoFilename);
        $this->add($contactName);
        $this->add($contactEmail);
        $this->add($contactPhone);
        $this->add($city);
        $this->add($contry);
        $this->add($price);
        $this->add($deleteCode);
    }
}
