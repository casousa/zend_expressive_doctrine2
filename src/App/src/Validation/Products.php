<?php

namespace App\Validation;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class Products 
{
    /**
     * @var InputFilter 
     */
    protected $inputFilter;
    
    /**
     * @var int 
     */
    protected $id;
    
    /**
     * @var string 
     */
    protected $name;
    
    /**
     * @var string 
     */
    protected $price;
    
    /**
     * @var string 
     */
    protected $description;
    
    /**
     * Configura os filtros dos campos da entidade
     *
     * @return Zend\InputFilter\InputFilter
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array(
                        'name'    => 'StringToUpper',
                        'options' => array(
                            'encoding' => 'UTF-8'
                        )
                    )
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'price',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 12,
                        ),
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'description',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array(
                        'name'    => 'StringToUpper',
                        'options' => array(
                            'encoding' => 'UTF-8'
                        )
                    )
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 2,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
           
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
