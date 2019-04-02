<?php

namespace InvoicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InvoicesBundle\Entity\InvoiceData;
use InvoicesBundle\Form\InvoiceDataType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class InvoiceDataController extends Controller
{
    /**
     * @Route("/invoiceData", name="invoiceData_home")
     */
    public function indexAction()
    {
        return $this->render('@Invoices/InvoiceData/index.html.twig');
    }

    /**
	 * @Route("/invoiceData/add_new", name="invoiceData_new")
     */
    public function addNewAction(Request $request, IntegerType $invoiceNumber)
    {

		$invoiceData = new InvoiceData();
		
		$form = $this->createForm(InvoiceDataType::class,$invoiceData);
		
		$form->handleRequest($request);
	
	
	       if ($form->isSubmitted() && $form->isValid()) {
			   
			//$form->get('numeroFattura')->setData($form->get('idFattura')->getData());

			$invoiceData = $form->getData();

	           $entityManager = $this->getDoctrine()->getManager();
	           $entityManager->persist($invoiceData);
	           $entityManager->flush();

	           return $this->render('home');
	       }
		
		
        return $this->render('@Invoices/InvoiceData/form.html.twig',array('form'=>$form->createView()));
		
		
	}
	
}
