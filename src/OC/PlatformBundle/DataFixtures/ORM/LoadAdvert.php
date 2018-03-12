<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadAdvert.php
namespace OC\PlatformBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Advert;
class LoadAdvert implements FixtureInterface, OrderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $tab = [
              [
                'title' =>'Recherche développeur Symfony',
                'author' => 'Fabien',
                'content' => 'Nous recherchons un développeur Symfony débutant sur Toulouse.',
                'image' => $manager->getRepository('OCPlatformBundle:Image')->findOneByAlt('Crazy Train'),
                'categories' => [
                                  $manager->getRepository('OCPlatformBundle:Category')->findOneByName('Développement web'),
                                  $manager->getRepository('OCPlatformBundle:Category')->findOneByName('Intégration')
                                ]
              ],
              [
                'title'      =>'Recherche développeur PHP',
                'author'     => 'Rasmus',
                'content'    => 'Nous recherchons un développeur PHP expérimenté sur Toulouse.',
                'image'      => $manager->getRepository('OCPlatformBundle:Image')->findOneByAlt('Job de rêve'),
                'categories' => [ $manager->getRepository('OCPlatformBundle:Category')->findOneByName('Développement web') ]
              ],
              [
                'title'      => 'Recherche développeur Python',
                'author'     => 'Guido',
                'content'    => 'Nous recherchons un développeur Python sur Bangkok.',
                'image'      => NULL,
                'categories' => []
              ],
              [
                'title'      => 'Recherche développeur Linux',
                'author'     => 'Linus',
                'content'    => 'Nous recherchons un développeur Linux.',
                'image'      => $manager->getRepository('OCPlatformBundle:Image')->findOneByAlt('Tux'),
                'categories' => []
              ],
              [
                'title'      => 'Recherche développeur Ruby on Rails',
                'author'     => 'David',
                'content'    => 'Nous recherchons un développeur Ruby On Rails sur Paris',
                'image'      => $manager->getRepository('OCPlatformBundle:Image')->findOneByAlt('Ruby on Rails'),
                'categories' => [ $manager->getRepository('OCPlatformBundle:Category')->findOneByName('Développement web') ]
              ]
            ];
    foreach ($tab as $row) {
      // On crée la catégorie
      $advert = new Advert();
      $advert->setTitle($row['title']);
      $advert->setAuthor($row['author']);
      $advert->setContent($row['content']);
      $advert->setImage($row['image']);
      foreach ($row['categories'] as $category) {
        $advert->addCategory($category);
      }
      $manager->persist($advert);
    }
    $manager->flush();
  }
  public function getOrder() {
   return 3;
 }
}
