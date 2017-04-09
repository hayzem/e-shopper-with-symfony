<?php
namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $productService = $this->get('app_bundle.product_service');
        $categoryService = $this->get('app_bundle.category_service');

        $products = $productService->getProducts();
        $mainCategories = $categoryService->getMainCategories();

        return $this->render('home/index.html.twig', [
            'slider' => true,
            'leftMenu' => true,
            'products' => $products,
            'mainCategories' => $mainCategories,
        ]);
    }

    /**
     * @Route("/{categoryId}", name="category_products")
     * @param Request $request
     * @param $categoryId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryProductsAction(Request $request, $categoryId)
    {
        $productService = $this->get('app_bundle.product_service');
        $categoryService = $this->get('app_bundle.category_service');

        $category = $categoryService->getCategory($categoryId);

        if(!$category)
        {
            //throw error
        }

        $products = $productService->getProducts([
            'category' => $category
        ]);
        $mainCategories = $categoryService->getMainCategories();

        return $this->render('home/index.html.twig', [
            'slider' => false,
            'leftMenu' => true,
            'products' => $products,
            'mainCategories' => $mainCategories,
        ]);
    }


}