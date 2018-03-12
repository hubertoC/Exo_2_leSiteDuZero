<?php
namespace OC\PlatformBundle\Purger;
use Doctrine\ORM\EntityManagerInterface;
class PurgerAdvert
{
  private $em;
  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }
  function purge($days)
  {
    $advertRepository = $this->em->getRepository('OCPlatformBundle:Advert');
    $advertSkillRepository = $this->em->getRepository('OCPlatformBundle:AdvertSkill');
    $listAdverts = $advertRepository->getAdvertsToPurge(new \Datetime('-'.$days.' day'));

    foreach ($listAdverts as $advert)
    {
      $advertSkills = $advertSkillRepository->findByAdvert($advert);
      foreach ($advertSkills as $advertSkill)
      {
        $this->em->remove($advertSkill);
      }
      $this->em->remove($advert);
    }

    $this->em->flush();
  }
}
