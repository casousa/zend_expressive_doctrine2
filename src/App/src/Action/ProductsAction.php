<?php

namespace App\Action;

use App\Entity\Products as ProductsEntity;
use App\Form\Products as ProductsForm;
use App\Validation\Products as ValidationProducts;
use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class ProductsAction implements ServerMiddlewareInterface
{
    private $router;

    private $template;

    private $entityManager;

    public function __construct(Router\RouterInterface $router, Template\TemplateRendererInterface $template = null, EntityManager $entityManager)
    {
        $this->router        = $router;
        $this->template      = $template;
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $data = $this->entityManager->getRepository(ProductsEntity::class)->findAll();
        
        $form = new ProductsForm();
        
        $validation = new ValidationProducts();
        $form->setInputFilter($validation->getInputFilter());
        
        if($request->getMethod() == 'POST'){
            $post = $request->getParsedBody();
            unset($post['submit']);
            $post['id'] = 0;
            $form->setData($post);
            if($form->isValid()){
                $products = new ProductsEntity();
                $products->setId($post['id']);
                $products->setName($post['name']);
                $products->setPrice($post['price']);
                $products->setDescription($post['description']);
                
                $this->entityManager->persist($products);
                $this->entityManager->flush();
                return new RedirectResponse('/products');
            }
        }
        
        return new HtmlResponse($this->template->render('app::products', [
            'data' => $data,
            'form' => $form
        ]));
    }
}
