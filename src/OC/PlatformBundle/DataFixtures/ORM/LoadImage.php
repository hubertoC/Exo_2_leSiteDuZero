<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadImage.php
namespace OC\PlatformBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Image;
class LoadImage implements FixtureInterface, OrderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $names = array(
       ['http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg', 'Job de rêve'],
       ['https://openclipart.org/image/100px/svg_to_png/239507/Crazy-Train.png', 'Crazy Train'],
       ['https://openclipart.org/image/100px/svg_to_png/252137/Linux-Pinguino.png', 'Tux'],
       ['https://upload.wikimedia.org/wikipedia/commons/9/9c/Ruby_on_Rails_logo.jpg','Ruby on Rails']
    );
    foreach ($names as $name) {
      // On crée l'Image
      $image = new Image();
      $image->setUrl($name[0]);
      $image->setAlt($name[1]);
      // On la persiste
      $manager->persist($image);
    }
    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
  public function getOrder() {
    return 1;
  }
}
