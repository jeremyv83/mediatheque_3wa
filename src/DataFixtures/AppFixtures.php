<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Comment;
use App\Entity\Document;
use App\Entity\DocumentType;
use App\Entity\Emprunt;
use App\Entity\Logs;
use App\Entity\Rencontre;
use App\Entity\User;

use Faker\Factory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $types = [
            "Livre",
            "CD",
            "DVD",
            "Revue",
            "Archives"
        ];

        $registeredTypes = [];
        $registeredAuteurs = [];
        $registeredDocuments = [];

        for($t = 0; $t < 5; $t++){
            $type = new DocumentType();
            $type->setName($types[$t]);
            $manager->persist($type);

            array_push($registeredTypes, $type);
        }

        for($a = 0; $a < 3; $a++){
            $auteur = new Auteur();
            $auteur->setName($faker->name());
            $manager->persist($auteur);

            for($d = 0; $d < 10; $d++){
                $doc = new Document();

                $indexTypes = $d < 5 ? $d : $d / 2;
                $isPhysique = $d % 2 !== 0 ? false : true;
                $isFragile = $d % 3 === 0 && !$isPhysique ? false : true;

                $doc->setAuteur($auteur)
                    ->setDocumentType($registeredTypes[$indexTypes])
                    ->setName($faker->words(2, true))
                    ->setDescription($faker->text(150))
                    ->setFragile($isFragile)
                    ->setPhysique($isPhysique)
                    ->setQuantity($a + $d)
                    ->setDate(new \DateTimeImmutable());

                $manager->persist($doc);

                array_push($registeredDocuments, $doc);
            }

            array_push($registeredAuteurs, $auteur);
        }

        for($u = 0; $u < 10; $u++){

            $user = new User();
            $user->setEmail($faker->email())
                ->setPassword($faker->word(8))
                ->setRoles([]);
            if($u % 2 === 0){
                $user->addRecommandation($registeredDocuments[2])
                    ->addReserved($registeredDocuments[3]);

            }
            $manager->persist($user);

            if($u % 2 === 0){
                $log = new Logs();
                $log->setUser($user)
                    ->setDocuments($registeredDocuments[2])
                    ->setActions($user->getEmail() . " a recommandé " . $registeredDocuments[2]->getName());
                $manager->persist($log);

                $log = new Logs();
                $log->setUser($user)
                    ->setDocuments($registeredDocuments[3])
                    ->setActions($user->getEmail() . " a réservé " . $registeredDocuments[3]->getName());
                $manager->persist($log);
            }

            for($c = 0; $c < 3; $c++){
                $indexDocuments = $u * $c;
                $comment = new Comment();
                $comment->setDocument($registeredDocuments[$indexDocuments])
                    ->setAuthor($user)
                    ->setText($faker->text(150));
                $manager->persist($comment);
            }

            for($e = 0; $e < 3; $e++){
                $indexDocuments = $u * $e;
                $emprunt = new Emprunt();
                $emprunt->setDocument($registeredDocuments[$indexDocuments])
                    ->setUser($user)
                    ->setEtatRemise($e + 1)
                    ->setDateEmprunt(new \DateTimeImmutable())
                    ->setDateRemise(new \DateTimeImmutable('2022-03-08'));
                $manager->persist($emprunt);

                $log = new Logs();
                $log->setUser($user)
                    ->setDocuments($registeredDocuments[$indexDocuments])
                    ->setActions($user->getEmail() . " a emprunté " . $registeredDocuments[$indexDocuments]->getName());
                $manager->persist($log);
            }

            for($r = 0; $r < 3; $r++){
                $rencontre = new Rencontre();
                $rencontre->setDate(new \DateTimeImmutable())
                    ->addAuteur($registeredDocuments[$r]->getAuteur())
                    ->addLinkedDocument($registeredDocuments[$r])
                    ->addParticipant($user);
                $manager->persist($rencontre);

            }
        }

        $manager->flush();
    }
}
