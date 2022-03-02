<?php

namespace App\DataFixtures;

use App\Entity\Librarian;
use App\Entity\Member;
use App\Entity\Visitor;
use App\Entity\CD;
use App\Entity\DVD;
use App\Entity\Book;
use App\Entity\Auteur;
use App\Entity\Logs;
use App\Entity\Rencontre;
use App\Entity\Comment;
use App\Entity\Emprunt;


use Faker\Factory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
//        USERS
        for ($i = 0; $i < 30; $i++) {
            if ($i < 10) {
                $user = new Librarian();
            } elseif ($i < 20) {
                $user = new Member();
            } else {
                $user = new Visitor();
            }
            $user->setName($faker->name);
            $user->setPassword($faker->password);
            $user->setEmail($faker->email);

            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }

// AUTEURS
        for ($i = 0; $i < 10; $i++) {
            $auteur = new Auteur();
            $auteur->setName($faker->name);
            $manager->persist($auteur);
            $this->addReference('auteur_' . $i, $auteur);
        }

        //DOCUMENTS
        for ($i = 0; $i < 30; $i++) {
            if ($i < 10) {
                $document = new CD();
            } elseif ($i < 20) {
                $document = new DVD();
            } else {
                $document = new Book();
            }
            $document->setDate($faker->dateTime);
            $document->setDescription($faker->text);
            $document->setFragile($faker->boolean);
            $bool = $faker->boolean;
            $document->setPhysique($bool);
            if ($bool) {
                $document->setQuantity($faker->numberBetween(1, 10));
            } else {
                $document->setQuantity(0);
            }
            $document->setName($faker->sentence(3));
            $document->setAuteur($this->getReference('auteur_' . $faker->numberBetween(0, 9)));
            $document->addReservedBy($this->getReference('user_' . $faker->numberBetween(0, 29)));
            $document->addRecommandedBy($this->getReference('user_' . $faker->numberBetween(0, 29)));
            $manager->persist($document);
            $this->addReference('document_' . $i, $document);
        }

        //LOGS
        for ($i = 0; $i < 30; $i++) {
            $log = new Logs();
            $log->setDate($faker->dateTime);
            $log->setActions($faker->text);
            $log->setDocuments($this->getReference('document_' . $faker->numberBetween(0, 29)));
            $log->setUser($this->getReference('user_' . $faker->numberBetween(0, 29)));
            $manager->persist($log);
            $this->addReference('log_' . $i, $log);
        }

        //RENCONTRE
        for ($i = 0; $i < 30; $i++) {
            $rencontre = new Rencontre();
            $rencontre->setDate($faker->dateTime);
            $rencontre->setTitle($faker->sentence(3));
            for ($j = 0; $j < 5; $j++) {
                $rencontre->addParticipant($this->getReference('user_' . $faker->numberBetween(0, 29)));
            }
            $rencontre->addParticipant($this->getReference('user_' . $faker->numberBetween(0, 29)));
            $rencontre->addAuteur($this->getReference('auteur_' . $faker->numberBetween(0, 9)));
            $manager->persist($rencontre);
            $this->addReference('rencontre_' . $i, $rencontre);
        }

        //COMMENT
        for ($i = 0; $i < 30; $i++) {
            $comment = new Comment();
            $comment->setText($faker->text);
            $comment->setAuthor($this->getReference('user_' . $faker->numberBetween(0, 29)));
            $comment->setDocument($this->getReference('document_' . $faker->numberBetween(0, 29)));
            $manager->persist($comment);
            $this->addReference('comment_' . $i, $comment);
        }

        //EMPRUNT
        for ($i = 0; $i < 30; $i++) {
            $emprunt = new Emprunt();
            $emprunt->setUser($this->getReference('user_' . $faker->numberBetween(0, 29)));
            $emprunt->setDocuments($this->getReference('document_' . $faker->numberBetween(0, 29)));
            $emprunt->setDateEmprunt($faker->dateTime);
            if ($faker->boolean) {
                $emprunt->setDateRemise($faker->dateTime);
                $rand = rand(0, 5);
                $emprunt->setEtatRemise($rand);
            }
            $manager->persist($emprunt);
            $this->addReference('emprunt_' . $i, $emprunt);
        }

        $manager->flush();
    }
}
