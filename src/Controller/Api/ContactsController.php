<?php

namespace App\Controller\Api;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
     * @Route("/contacts/{id<\d+>}", name="api_contacts_get", methods={"GET","HEAD"})
     * 
     * @param int $id
     * @return JsonResponse
     * @throws NotFoundHttpException
     */
    public function getOne(int $id): JsonResponse
    {
        if (null === $contact  = $this->contactRepository->find($id)) {
            throw new NotFoundHttpException('Invalid contact identifier.');
        }
        
        return $this->json($contact);
    }
    
    /**
     * @Route("/contacts/search", name="api_contacts_search", methods={"GET","HEAD"})
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $q = $request->query->get('q');
        
        return $this->json($this->contactRepository->search($q));
    }
    
    /**
     * @Route("/contacts/search", name="api_contacts_search", methods={"GET","HEAD"})
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        if ('application/json' !== $request->getContentType()) {
            throw new HttpException(400, 'Content-Type header must be "application/json".');
        }
        
        $data = json_decode($request->getContent(), true);
        
        if (false === is_array($data)) {
            throw new HttpException(400, 'Invalid JSON body.');
        }
        
        $contact = Contact::fromArray($data);

        $this->getDoctrine()->getManager()->persist($contact);
        $this->getDoctrine()->getManager()->flush();
        
        return $this->json($contact);
    }
}
