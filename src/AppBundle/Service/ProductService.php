<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * @author Ali Atasever <aliatasever@gmail.com>
 */
class ProductService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $options
     * @return \AppBundle\Entity\Product[]|array
     */
    public function getProducts(array $options = [])
    {
        $productRepository = $this->entityManager->getRepository('AppBundle:Product');
        $criteria = [];

        if(array_key_exists('category', $options))
        {
            $criteria['category'] = $options['category'];
        }

        return $productRepository->findBy($criteria);
    }
}