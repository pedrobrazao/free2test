<?php

namespace App\Controller\Api;

use App\Service\PostCodesServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class PostcodeController extends AbstractController
{

    private $postCodesService;

    /**
     * @param PostCodesServiceInterface $postCodesService
     */
    public function __construct(PostCodesServiceInterface $postCodesService)
    {
        $this->postCodesService = $postCodesService;
    }

    /**
     * @Route("/postcode/{postcode}/lookup", name="api_postcode_lookup", methods={"GET","HEAD"})
     * 
     * @param string $postcode
     * @return JsonResponse
     */
    public function lookup(string $postcode): JsonResponse
    {
        if (null === $data  = $this->postCodesService->lookup($postcode)) {
            throw new NotFoundHttpException('Invalid postcode.');
        }
        
        return $this->json($data);
    }

    /**
     * @Route("/postcode/{postcode}/validate", name="api_postcode_validate", methods={"GET","HEAD"})
     * 
     * @param string $postcode
     * @return JsonResponse
     */
    public function validate(string $postcode): JsonResponse
    {
        $data  = $this->postCodesService->validate($postcode);
        
        return $this->json($data);
    }
}
