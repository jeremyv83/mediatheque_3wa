<?php

namespace App\Controller;

use App\Entity\Rencontre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RencontreController extends AbstractController
{
    /**
     * @Route("/rencontres", name="app_rencontre")
     */
    public function show_rencontres(EntityManagerInterface $entity_manager): Response
    {
        $rencontres = $entity_manager
            ->getRepository(Rencontre::class)
            ->findAll();

        return $this->render('userVIews/showrencontres.html.twig', [
            'rencontres' => $rencontres,
        ]);
    }

    /**
     * @Route("/rencontre/{id}/participer", name="app_rencontre_participer", methods={"POST"})
     */
    public function rencontre_participer(Rencontre $rencontre, EntityManagerInterface $entity_manager): Response
    {
        $rencontre->addParticipant($this->getUser());
        $entity_manager->flush();

        return $this->redirectToRoute('app_rencontre');
    }

    /**
     * @Route("rencontres/particiations", name="app_rencontre_particiations")
     */
    public function show_particiations(EntityManagerInterface $entity_manager): Response
    {
        $particiations = $this->getUser()->getRencontres();

        return $this->render('userVIews/showparticiations.html.twig', [
            'participations' => $particiations,
        ]);
    }

    /**
     * @Route ("/rencontre/{id}/annuler", name="app_rencontre_unparticipe", methods={"POST"})
     */
    public function rencontre_unparticipe(Rencontre $rencontre, EntityManagerInterface $entity_manager): Response
    {
        $rencontre->removeParticipant($this->getUser());
        $entity_manager->flush();

        return $this->redirectToRoute('app_rencontre_particiations');
    }
}
