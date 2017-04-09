<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class CategoryService
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
     * @return \AppBundle\Entity\Category[]|array
     */
    public function getMainCategories()
    {
        $categoryRepository = $this->entityManager->getRepository('AppBundle:Category');

        $categories = $categoryRepository->findBy([
            'parent' => null,
        ]);

        return $categories;
    }

    /**
     * @param $id
     * @return \AppBundle\Entity\Category|null|object
     */
    public function getCategory($id)
    {

        return $this->entityManager->getRepository('AppBundle:Category')->find($id);
    }
}