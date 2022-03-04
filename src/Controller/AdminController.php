<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Librarian;
use App\Entity\Logs;
use App\Entity\Member;
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


    /**
     * @Route("/admin/manage/documents", name="admin_manage_documents")
     */
    public function manageDocuments(EntityManagerInterface $entity_manager): Response
    {
        $documents = $entity_manager
            ->getRepository(Document::class)
            ->findAll();

        return $this->render('admin/managment/documents.html.twig', [
            'controller_name' => 'AdminController',
            'documents' => $documents
        ]);
    }

    /**
     * @Route("/admin/manage/users", name="admin_manage_users")
     */
    public function manageUsers(EntityManagerInterface $entity_manager): Response
    {
        $members = $entity_manager
            ->getRepository(Member::class)
            ->findAll();

        return $this->render('admin/managment/users.html.twig', [
            'controller_name' => 'AdminController',
            'members' => $members
        ]);
    }

    /**
     * @Route("/admin/manage/employees", name="admin_manage_employees")
     */
    public function manageEmployees(EntityManagerInterface $entity_manager): Response
    {
        $librarians = $entity_manager
            ->getRepository(Librarian::class)
            ->findAll();

        return $this->render('admin/managment/employees.html.twig', [
            'controller_name' => 'AdminController',
            'librarians' => $librarians
        ]);
    }
}
