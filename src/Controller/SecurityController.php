<?php

namespace App\Controller;

use App\Form\ChangePasswordFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

        /**
     * @Route("/reset-password", name="app_reset_password")
     */
    public function resetPassword(Request $request)
    {
        
        $form = $this->createForm(ChangePasswordFormType::class, $this->getUser());

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $form = $form->getData();
            $form->setRedefinePassword(false);

        // $password = $this->encoder->encodePassword($employe, 'info123@');
        // $employe->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('employe');
        }else{
            return $this->render('security/reset-password.html.twig', ['form' => $form->createView()]);
        }

    }
}
