<?php

namespace App\Controller\Api;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ContactsController extends AbstractController
{

    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("/contacts/{id}", name="api_contacts_get", methods={"GET","HEAD"})
     * 
     * @param string $id
     * @return JsonResponse
     */
    public function lookup(int $id): JsonResponse
    {
        if (null === $contact  = $this->contactRepository->find($id)) {
            throw new NotFoundHttpException('Invalid contact identifier.');
        }
        
        return $this->json($contact);
    }
}
