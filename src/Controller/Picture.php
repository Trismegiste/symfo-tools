<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Repository\Storage;
use MongoDB\BSON\ObjectId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for pictures
 */
class Picture extends AbstractController
{

    protected Storage $repository;

    public function __construct(Storage $repo)
    {
        $this->repository = $repo;
    }

    /**
     * @Route("/picture/{pk}", methods={"GET"}, requirements={"pk"="[\da-f]{24}"})
     */
    public function read(string $pk, Request $request): Response
    {
        $response = $this->repository->get(new ObjectId($pk));
        $response->setSharedMaxAge(86400);

        if ($response->isNotModified($request)) {
            // return the 304 Response immediately
            return $response;
        }

        return $response;
    }

    /**
     * @Route("/admin/picture/list", methods={"GET"})
     */
    public function adminList()
    {
        $it = $this->repository->searchByMimeType('image/jpeg');

        return $this->render('back/picture_listing.html.twig', ['listing' => $it]);
    }

}
