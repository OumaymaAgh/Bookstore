<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory ; 
use App\Entity\Livre ; 
use App\Entity\Auteur ;
use App\Entity\Genre ; 
use App\Entity\User ; 
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class AppFixtures extends Fixture
{
     
    public function load(ObjectManager $manager): void
    {

        $this->faker = Factory::create();


        for($i=1 ; $i<=10 ;$i++){
            $genre = new Genre();
            $genre->setNom('Genre '.$i);
            
            $this->addReference('genre_'.$i,$genre);

            $manager->persist($genre) ;

        }


        
        for($i=1 ; $i<=20 ;$i++){
            $auteur = new Auteur() ;
            
            $auteur->setNomPrenom($this->faker->name)
                    ->setSexe($this->faker->randomElement($array = array('F','M')))
                    ->setDateDeNaissance($this->faker->dateTime($max = 'now', $timezone = null))
                    ->setNationalite($this->faker->country)

             ; 
             $this->addReference('auteur_'.$i,$auteur);

            $manager->persist($auteur) ;
        }


       for($i=1 ; $i<=50 ;$i++){
            $livre = new livre();
            for($j=1;$j<=$this->faker->numberBetween(1,3);$j++){
                $livre->addGenre($this->getReference('genre_'.$this->faker->numberBetween(1,10)));
            }

            for($j=1;$j<=$this->faker->numberBetween(1,3);$j++){
                $livre->addAuteur($this->getReference('auteur_'.$this->faker->numberBetween(1,20)));
            }
            
            $livre->setIsbn($this->faker->isbn13()) 
                    ->setTitre($this->faker->name) 
                    ->setNombrePages($this->faker->randomNumber)
                    ->setDateDeParution($this->faker->dateTime($max = 'now', $timezone = null))
                    ->setNote($this->faker->numberBetween(1,20))
                    ;
                    $this->addReference('livre_'.$i,$livre);
            $manager->persist($livre) ;
        }

        
        $user = new user() ; 
        $user->setEmail('admin123@gmail.com')
                ->setPassword("123456789") 
                ->setRoles(["ROLE_ADMIN"])
                ; 
        $manager->persist($user) ; 
        
        

        


        $manager->flush();
    }
}
