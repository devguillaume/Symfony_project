<?php

namespace SupQuote\QuoteBundle\Controller;

use SupQuote\QuoteBundle\Entity\Quote;
use SupQuote\QuoteBundle\Form\Type\QuoteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Acl\Exception\NoAceFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * @Route("/quote")
 */
class QuoteController extends Controller
{
    /**
     * @Route("/add")
     * @Template()
     * @Method ({"GET","POST"})
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request)
    {
        $quote = new Quote($this->getUser());
        $form = $this->createFormBuilder($quote)->add('content', 'textarea', array('label' => 'Content'))->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($quote);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/show/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('SupQuoteQuoteBundle:Quote');
        $showQuote = $repository ->findOneBy(array('id' => $id, 'published' => true));

//        Verifier si il y a bien un quote existant
        if (!$showQuote){
            throw new NotFoundHttpException();

        }

        return array("quotes" => $showQuote);
    }

    /**
     * @Route("/edit/{id}")
     * @Security("has_role('ROLE_USER')")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $quote = $this->getDoctrine()->getRepository("SupQuoteQuoteBundle:Quote")->find($id);
        $quoteForm = $this->createFormBuilder($quote)->add('content', 'textarea', array('label' => 'Content'))->getForm();

        $quoteForm->handleRequest($request);

        if ($quoteForm->isValid()) {

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($quote);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return array('form' => $quoteForm->createView());
    }

    /**
     * @Route("/delete/{id}")
     * @Security("has_role('ROLE_USER')")
     * @Template()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('SupQuoteQuoteBundle:Quote');
        $quote = $repository->find($id);
        $em->remove($quote);
        $em->flush();
        return array("quote" => $quote, "id" => $id);
    }

    /**
     * @Template()
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository('SupQuoteQuoteBundle:Quote');
        //        Verifie si je suis administrateur

        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $quotes = $repository ->findAll();
        }else{
            $quotes = $repository ->findBy(array("published" => true));
        }
        return array("quotes" => $quotes);
    }

    /**
     * @Route("/publish/{id}")
     * @Template()
     */
    public function publishAction(Request $request, $id)
    {
        $quote = $this->publish($id);
        return array("quote" => $quote);
    }

    public function publish($id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException("Action unauthorized");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $quote = $em->getRepository('SupQuoteQuoteBundle:Quote')->find($id);
        dump($quote);
        $quote->setPublished(true);
        $em->persist($quote);
        $em->flush();

        return $quote;
    }

    public function countQuote (){

        $repository = $this->getDoctrine()->getRepository('SupQuoteQuoteBundle:Quote');
        $repository->count();

        return array();
    }
}
