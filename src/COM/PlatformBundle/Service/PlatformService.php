<?php

namespace COM\PlatformBundle\Service;

use Doctrine\ORM\EntityManager;
use COM\BlogBundle\Entity\Post;
use COM\SchoolBundle\Entity\School;
use COM\AdvertBundle\Entity\Advert;
use COM\PlatformBundle\Entity\View;

class PlatformService {

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getLocale($locale) {
        $localeRepository = $this->em->getRepository('COMPlatformBundle:Locale');
        $locale = $localeRepository->findOneBy(array('locale' => $locale));
        return $locale;
    }

    public function getLocales() {
        $localeRepository = $this->em->getRepository('COMPlatformBundle:Locale');
        $locales = $localeRepository->findAll();
        return $locales;
    }
	
    public function registerView($entity, $request) {
		
		$view = new View();
		if ($entity instanceof School){
			$view->setSchool($entity);
		}else if($entity instanceof Advert){
			$view->setAdvert($entity);
		}else if($entity instanceof Post){
			$view->setPost($entity);
		}else{
			
		}
		$view->setUser(null);
		$clientIp = $request->getClientIp();
		$view->setIp($clientIp);
		$view->setDate(new \DateTime());
		
		$this->em->persist($view);
		$this->em->flush();
		
		return $view;
    }
	   
	function sluggify($str) {

        $before = array(
            '/[^a-z0-9\s]/',
            array(
				'/\s/',
				'/--+/',
				'/---+/'),
            '/\&/'
        );

        $after = '-';
        
        $str = preg_replace($before[2], $after, $str);
        $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
    
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'

        $str = strtolower($str);
        $str = preg_replace($before[0], $after, $str);
        $str = trim($str);
        $str = preg_replace($before[1], $after, $str);
        $str = trim($str, '-');

        return $str;
    }

}