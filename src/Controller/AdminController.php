<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Logs;
use App\Entity\Rencontre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/documents", name="admin_documents")
     */
    public function documents(EntityManagerInterface $entity_manager): Response
    {
        $documents = $entity_manager
            ->getRepository(Document::class)
            ->findAll();

        return $this->render('admin/documents.html.twig', [
            'controller_name' => 'AdminController',
            'documents' => $documents
        ]);
    }

    /**
     * @Route("/admin/rencontres", name="admin_rencontres")
     */
    public function rencontres(EntityManagerInterface $entity_manager){
        $rencontres = $entity_manager
            ->getRepository(Rencontre::class)
            ->findAll();

        return $this->render('admin/rencontres.html.twig', [
            'rencontres' => $rencontres
        ]);
    }

    /**
     * @Route("/admin/logs", name="admin_logs")
     */
    public function logs(EntityManagerInterface $entity_manager){
        $logs = $entity_manager
            ->getRepository(Logs::class)
            ->findAll();

        return $this->render("admin/logs.html.twig", [
            'logs' => $logs
        ]);
    }
}
