<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadApplication.php
namespace OC\PlatformBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Application;
class LoadApplication implements FixtureInterface, OrderedFixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $tab = array(
      ['Vincent', 'J\'ai toutes les qualités requises.', $manager->getRepository('OCPlatformBundle:Advert')->findOneByTitle('Recherche développeur Python')],
      ['Eric', 'Je suis très motivé.', $manager->getRepository('OCPlatformBundle:Advert')->findOneByTitle('Recherche développeur Symfony')],
      ['Ingo', 'Je suis un Dieu', $manager->getRepository('OCPlatformBundle:Advert')->findOneByTitle('Recherche développeur Linux')],
      ['Tux', 'Je ne suis pas un pingouin', $manager->getRepository('OCPlatformBundle:Advert')->findOneByTitle('Recherche développeur Linux')]
      );
    foreach ($tab as $row) {
      // On crée la catégorie
      $application = new Application();
      $application->setAuthor($row[0]);
      $application->setContent($row[1]);
      $application->setAdvert($row[2]);
      $manager->persist($application);
    }
    $manager->flush();
  }
  public function getOrder() {
    return 4;
  }
}
