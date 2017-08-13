<?php

namespace App\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class Products extends Form
{
    public function __construct()
    {
        parent::__construct('formProducts');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form');
        
        $this->add([
            'name' => 'name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Nome'
            ],
            'attributes' => [
                'id' => 'name'
            ]
        ]);
        
        $this->add([
            'name' => 'price',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Preço'
            ],
            'attributes' => [
                'id' => 'price'
            ]
        ]);
        
        $this->add([
            'name' => 'description',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Descrição'
            ],
            'attributes' => [
                'id' => 'description'
            ]
        ]);
        
        $this->add([
            'name' => 'submit',
            'type' => Element\Submit::class,
            'attributes' => [
                'type' => 'submit',
                'value' => 'Cadastrar',
                'title' => 'Cadastrar',
            ]
        ]);
    }
}
