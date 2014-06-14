<?php

namespace MonSac\DeSportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function indexAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$users = $em->createQuery("SELECT u FROM MonSacDeSportBundle:User u WHERE u.roles NOT LIKE '%ROLE_SUPER_ADMIN%' ")
    				->getResult();
    	
        return $this->render('MonSacDeSportBundle:User:index.html.twig', array(
        	'users' => $users,
        ));
    }

    public function commandesAction($id)
    {
    	$user = $this->getRepository('MonSacDeSportBundle:User')->find($id);

    	if (!$user) {
    		throw $this->createNotFoundException('Utilisateur inexistant.');
    	}

    	$commandes = $user->getCommandes();

        return $this->render('MonSacDeSportBundle:User:commandes.html.twig', array(
        	'commandes' => $commandes,
        ));
    }
}
