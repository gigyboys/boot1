<?php

namespace COM\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use COM\PlatformBundle\Entity\Locale;
use COM\UserBundle\Entity\User;
use COM\SchoolBundle\Entity\School;
use COM\SchoolBundle\Entity\Logo;
use COM\SchoolBundle\Form\Type\LogoType;
use COM\SchoolBundle\Entity\SchoolTranslate;
use COM\SchoolBundle\Form\Type\SchoolInitType;
use COM\SchoolBundle\Form\Type\SchoolGeneralType;
use COM\SchoolBundle\Form\Type\SchoolTranslateType;

class SchoolAdminController extends Controller
{
	
    
	
	/*
	 * School Edition admin
	 */
    public function indexAction($school_id)
    {
		$em = $this->getDoctrine()->getManager();
		$schoolRepository = $em->getRepository('COMSchoolBundle:School');
		$schoolAdminRepository = $em->getRepository('COMSchoolBundle:SchoolAdmin');
		$school = $schoolRepository->find($school_id);
		
        $schoolAdmins = $schoolAdminRepository->findBy(array(
            'school' => $school,
            'active' => true,
        ));
		
        return $this->render('COMAdminBundle:school:school_admin.html.twig', array(
			'school' => $school,
			'schoolAdmins' => $schoolAdmins,
		));
    }

	public function changeLogoAction($school_id)
    {
        
        $em = $this->getDoctrine()->getManager();
		$schoolRepository = $em->getRepository('COMSchoolBundle:School');
        $logoRepository = $em->getRepository('COMSchoolBundle:Logo');
        
        $logo = new Logo();
        $school = $schoolRepository->find($school_id);
        
        $formLogo = $this->get('form.factory')->create(new LogoType, $logo);
        $formLogo->handleRequest($this->getRequest());

        if ($formLogo->isValid()) {
            $logos = $logoRepository->findBy(array('school' => $school));
            
            foreach ($logos as $schoolLogo) {
                $schoolLogo->setCurrentLogo(false);
            }
			
            $logo->setCurrentLogo(true);
			
            $logo->setSchool($school);
            $logo->setCurrentLogo(true);
			
            $em->persist($logo);
            $em->flush();
			
            $logo116x116 = $this->renderView('COMAdminBundle:school:include/logo116x116.html.twig', array(
			  'logoPath' => $logo->getWebPath()
			));
			
			$response = new Response();
            $response->setContent(json_encode(array(
                'state' => 1,
                'logo116x116' => $logo116x116,
            )));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }

        $response = new Response();
		$response->setContent(json_encode(array(
			'state' => 0,
		)));
		$response->headers->set('Content-Type', 'application/json');
		
		return $response;
    }
	
    public function editSchoolGeneralAction($id, Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$schoolRepository = $em->getRepository('COMSchoolBundle:School');
        
        $school = $schoolRepository->find($id);
        
		$schoolTemp = new School();
		$formSchoolGeneral = $this->get('form.factory')->create(new SchoolGeneralType(), $schoolTemp);
		
        $response = new Response();
		
		if ($formSchoolGeneral->handleRequest($request)->isValid()) {
			$school->setName($schoolTemp->getName());
			$school->setShortName($schoolTemp->getShortName());
			$school->setSlug($schoolTemp->getSlug());
            
			$em->persist($school);
            $em->flush();

            $response->setContent(json_encode(array(
                'state' => 1,
                'name' => $school->getName(),
                'shortName' => $school->getShortName(),
                'slug' => $school->getSlug(),
            )));
		}else{
            $response->setContent(json_encode(array(
                'state' => 0,
            )));
		}
        $response->headers->set('Content-Type', 'application/json');
		return $response;
    }
	
    public function editSchoolTranslateAction($id, $locale, Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$schoolRepository = $em->getRepository('COMSchoolBundle:School');
		$schoolTranslateRepository = $em->getRepository('COMSchoolBundle:SchoolTranslate');
		$localeRepository = $em->getRepository('COMPlatformBundle:Locale');
        
        $school = $schoolRepository->find($id);
        $localeObj = $localeRepository->findOneBy(array(
			'locale' => $locale,
		));
        
		$schoolTranslateTemp = new SchoolTranslate();
		$formSchoolTranslate = $this->get('form.factory')->create(new SchoolTranslateType(), $schoolTranslateTemp);
		
        $response = new Response();
		
		if ($formSchoolTranslate->handleRequest($request)->isValid()) {
			$schoolTranslate = $schoolTranslateRepository->findOneBy(array(
				'school' => $school,
				'locale' => $localeObj,
			));
			if(!$schoolTranslate){
				$schoolTranslate = new SchoolTranslate();
				$schoolTranslate->setLocale($localeObj);
				$schoolTranslate->setSchool($school);
			}
			$schoolTranslate->setName($schoolTranslateTemp->getName());
			$schoolTranslate->setShortDescription($schoolTranslateTemp->getShortDescription());
			$schoolTranslate->setDescription($schoolTranslateTemp->getDescription());
            
			$em->persist($schoolTranslate);
            $em->flush();

            $response->setContent(json_encode(array(
                'state' => 1,
                'name' => $schoolTranslate->getName(),
                'shortDescription' => $schoolTranslate->getShortDescription(),
                'description' => $schoolTranslate->getDescription(),
            )));
		}else{
            $response->setContent(json_encode(array(
                'state' => 0,
            )));
		}
        $response->headers->set('Content-Type', 'application/json');
		return $response;
    }
}
