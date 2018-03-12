<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadAdvertSkill.php
namespace OC\PlatformBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\AdvertSkill;
class LoadAdvertSkill implements FixtureInterface, OrderedFixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Liste des noms de compétences à ajouter
    $tab = [
                      [
                        'advert' => $manager->getRepository('OCPlatformBundle:Advert')->findOneByTitle('Recherche développeur Symfony'),
                        'skill'  => $manager->getRepository('OCPlatformBundle:Skill')->findOneByName('Symfony'),
                        'level'  => 'Débutant'
                      ],
                      [
                        'advert' => $manager->getRepository('OCPlatformBundle:Advert')->findOneByTitle('Recherche développeur Symfony'),
                        'skill'  => $manager->getRepository('OCPlatformBundle:Skill')->findOneByName('PHP'),
                        'level'  => 'Avancé'
                      ],
                      [
                        'advert' => $manager->getRepository('OCPlatformBundle:Advert')->findOneByTitle('Recherche développeur Linux'),
                        'skill'  => $manager->getRepository('OCPlatformBundle:Skill')->findOneByName('Bloc-note'),
                        'level'  => 'Expert'
                      ],
                      [
                        'advert' => $manager->getRepository('OCPlatformBundle:Advert')->findOneByTitle('Recherche développeur Ruby on Rails'),
                        'skill'  => $manager->getRepository('OCPlatformBundle:Skill')->findOneByName('Ruby'),
                        'level'  => 'Avancé'
                      ]
                  ];
    foreach ($tab as $row) {
      $advertSkill = new AdvertSkill();
      $advertSkill->setSkill($row['skill']);

      $advertSkill->setAdvert($row['advert']);
      $advertSkill->setLevel($row['level']);
      $manager->persist($advertSkill);
    }
    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
  public function getOrder() {
     return 6;
   }
}
