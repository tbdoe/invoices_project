<?php

namespace InvoicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use InvoicesBundle\Entity\Invoice;
use InvoicesBundle\Form\InvoiceType;
use InvoicesBundle\Entity\InvoiceData;

class InvoiceController extends Controller
{
    /**
     * @Route("/invoice", name="invoice_home")
     */
    public function indexAction()
    {
        return $this->render('@Invoices/Invoice/index.html.twig');
    }
		
	    /**
		     * @Route("/invoice/add_new", name="invoice_new")
	     */
	    public function addNewAction(Request $request)
	    {

	$invoice = new Invoice();

	$invoiceData = $invoice->getInvoiceData();//new InvoiceData();
	$invoice->getinvoicesCollection()->add($invoiceData);

	$form = $this->createForm(InvoiceType::class,$invoice);

	$form->handleRequest($request);


		       if ($form->isSubmitted() && $form->isValid()) {

		//$form->get('numeroFattura')->setData($form->get('idFattura')->getData());

				   $invoice = $form->getData();
				   $invoiceData->setInvoiceId($invoice);
				   //$invoice->setInvoiceNumber($invoice->getInvoicesData()[0]);

		           $entityManager = $this->getDoctrine()->getManager();
		   			//$invoiceData->setInvoiceId($invoice);
		   		 	$entityManager->persist($invoiceData);
					$entityManager->persist($invoice);
		           $entityManager->flush();

		           return $this->render('@Invoices/Invoice/index.html.twig',array('inv'=>$invoice));
		       }


	        return $this->render('@Invoices/Invoice/form.html.twig',array('form'=>$form->createView()));
	    }
		
		//     /**
		// 	     * @Route("/invoice/add_new", name="invoice_new")
		//      */
		//     public function addNewAction(Request $request)
		//     {
		//
		// $invoice = new Invoice();
		//
		// $form = $this->createForm(InvoiceType::class,$invoice);
		//
		// $form->handleRequest($request);
		//
		//
		// 	       if ($form->isSubmitted() && $form->isValid()) {
		//
		// 	//$form->get('numeroFattura')->setData($form->get('idFattura')->getData());
		//
		// 	$invoice = $form->getData();
		//
		// 	           $entityManager = $this->getDoctrine()->getManager();
		// 	           $entityManager->persist($invoice);
		// 	           $entityManager->flush();
		//
		// 	   $invoiceNumber = $invoice->invoiceNumber;
		//
		// 	           return $this->render('invoiceData_new',array('invoiceNumber'=>$invoiceNumber));
		// 	       }
		//
		//
		//         return $this->render('@Invoices/Invoice/form.html.twig',array('form'=>$form->createView()));
		//     }
	
}