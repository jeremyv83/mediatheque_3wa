<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Document;
use App\Form\DocumentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("")
 */
class DocumentController extends AbstractController
{
    /**
     * @Route("admin/document/", name="app_document_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $documents = $entityManager
            ->getRepository(Document::class)
            ->findAll();

        return $this->render('admin/managment/documents.html.twig', [
            'documents' => $documents,
        ]);
    }

    /**
     * @Route("admin/document/new", name="app_document_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $document = new Book();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirectToRoute('app_document_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('document/new.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    /**
     * @Route("admin/document/{id}", name="app_document_show", methods={"GET"})
     */
    public function show(Document $document): Response
    {
        return $this->render('document/show.html.twig', [
            'document' => $document,
        ]);
    }

    /**
     * @Route("admin/document/{id}/edit", name="app_document_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Document $document, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_document_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('document/edit.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    /**
     * @Route("admin/document/{id}", name="app_document_delete", methods={"POST"})
     */
    public function delete(Request $request, Document $document, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $document->getId(), $request->request->get('_token'))) {
            $entityManager->remove($document);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_document_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("document/", name="app_document_show_member", methods={"GET"})
     */
    public function show_member(EntityManagerInterface $entityManager): Response
    {
        $documents = $entityManager
            ->getRepository(Document::class)
            ->findAll();

        return $this->render('userVIews/showdocument.html.twig', [
            'documents' => $documents,
        ]);
    }

    /**
     * @Route("document/{id}/reserve", name="app_document_reserve", methods={"POST"})
     */
    public function reserve(Request $request, Document $document, EntityManagerInterface $entityManager): Response
    {
        $this->getUser()->addReserved($document);
        $entityManager->flush();

        return $this->redirectToRoute('app_document_show_member', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route ("documents/reserved", name="app_document_reserved", methods={"GET"})
     */
    public function reserved(EntityManagerInterface $entityManager): Response
    {
        $reserved = $this->getUser()->getReserved();

        return $this->render('userVIews/reserved.html.twig', [
            'reserved' => $reserved,
        ]);
    }

    /**
     * @Route("document/{id}/unreserve", name="app_document_unreserve", methods={"POST"})
     */
    public function unreserve(Request $request, Document $document, EntityManagerInterface $entityManager): Response
    {
        $this->getUser()->removeReserved($document);
        $entityManager->flush();

        return $this->redirectToRoute('app_document_reserved', [], Response::HTTP_SEE_OTHER);
    }
}
