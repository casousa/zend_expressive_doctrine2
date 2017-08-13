<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;
use App\Entity\Products;

class ProductsAction implements ServerMiddlewareInterface
{
    private $router;

    private $template;

    private $entityManager;

    public function __construct(Router\RouterInterface $router, Template\TemplateRendererInterface $template = null, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->router        = $router;
        $this->template      = $template;
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $data = [];

        $products = new Products();
        $products->name = 'Notebook';
        $products->price = 3000.00;
        $products->description = ' SSD 1TB';

        //$this->entityManager->persist($products);
        //$this->entityManager->flush();
        $data = $this->entityManager->getRepository(Products::class)->findAll();
        var_dump($data);

        return new HtmlResponse($this->template->render('app::products', $data));
    }
}
