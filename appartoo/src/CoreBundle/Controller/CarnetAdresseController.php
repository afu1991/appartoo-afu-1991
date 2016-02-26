<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CoreBundle\Entity\CarnetAdresse;
use CoreBundle\Form\CarnetAdresseType;

/**
 * CarnetAdresse controller.
 *
 */
class CarnetAdresseController extends Controller
{
    protected $messages = 'L\'ajout à bien était éffectué.';
    /**
     * Lists all CarnetAdresse entities.
     *
     */
    public function indexAction()
    {
        return $this->render('CoreBundle:carnetadresse:index.html.twig', array(
            'carnetAdresses' => $this->get('core.manager.user_manager')->find($this->getUser()->getId()),
        ));
    }

    /**
     * Creates a new CarnetAdresse entity.
     *
     */
    public function newAction(Request $request)
    {
        $carnetAdresse = new CarnetAdresse();
        $form = $this->createForm('CoreBundle\Form\CarnetAdresseType', $carnetAdresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $to = $carnetAdresse->getEmail();
            $findByEmail = $this->get('core.manager.user_manager')->findBy('email', $to);
            if ( empty($findByEmail)) {
                $this->addFlash(
                    'notice',
                    'Un Mail à était envoyé à l\'adresse suivant '. $to
                );
                $this->get('core.services.mailer')->sendContactMessage($this->getUser()->getUsername(), $to);
            }
            $carnetAdresse->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($carnetAdresse);
            $em->flush();
            $this->addFlash('notice', $this->messages);

            return $this->redirectToRoute('carnetadresse_index');
        }

        return $this->render('CoreBundle:carnetadresse:new.html.twig', array(
            'carnetAdresse' => $carnetAdresse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CarnetAdresse entity.
     *
     */
    public function editAction(Request $request, CarnetAdresse $carnetAdresse)
    {
        $editForm = $this->createForm('CoreBundle\Form\CarnetAdresseType', $carnetAdresse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $carnetAdresse->setUser($this->getUser());
            $em->persist($carnetAdresse);
            $em->flush();
            return $this->redirectToRoute('carnetadresse_index');
        }
        return $this->render('CoreBundle:carnetadresse:edit.html.twig', array(
            'carnetAdresse' => $carnetAdresse,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * METHODE GET FOR DELETE #
     */
    public function deleteAction($id)
    {
        $this->get('core.manager.carnet_adresse_manager')->remove($id);
        return $this->redirectToRoute('carnetadresse_index');
    }


}
