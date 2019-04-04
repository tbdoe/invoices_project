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
		     * @Route("/{invoiceEntity}", name="invoice_new")
	     */
	    public function addNewAction(Request $request, $invoiceEntity=null)
	    {
				$invoice = new Invoice();

				$form = $this->createForm(InvoiceType::class,$invoice);

				$form->handleRequest($request);

				//about form validation: inserting a preexisting invoice number throws error
				//(as the field is supposed to be unique). so, i tried to use UniqueEntity validator to solve the issue,
				//but there's no way to make it work (always throwing the error 'The annotation "@Doctrine\ORM\Mapping\UniqueEntity" in class InvoicesBundle\Entity\Invoice does not exist, or could not be auto-loaded.'): after adding the requires in composer.json, I am maybe still missing something. so...I spare me an ugly workaround to manually validate it, and I just report it. Same thing for amount field: '@ORM precision = 12' can't be validated,
				//so the user can actually set higher numbers. what a pity..!
							       if ($form->isSubmitted() && $form->isValid()) {

					   $invoice = $form->getData();

					   //operations on properties
					   $invoice->setInvoiceDataTotalAmount();

							           $entityManager = $this->getDoctrine()->getManager();
					   $entityManager->persist($invoice);
							           $entityManager->flush();

					   //add invoice id to invoice table by keeping it from the just flushed invoice.
					   //inelegant solution, must exist a better way.
							   		   $invoice->setInvoiceDataInvoice();
					   $entityManager->persist($invoice->getInvoiceData());

					   $entityManager->persist($invoice);
					   $entityManager->flush();

					   //pass the last inserted invoice to the view to be dumped
					   $insertedInvoiceId = $invoice->getId();
					   $invoiceDbEntry = $this->getDoctrine()
					           ->getRepository(Invoice::class)
					   		   ->find($insertedInvoiceId);

					   //if nothing went wrong, passes the db response; else, keeps the null default value
					   if($invoiceDbEntry){
					 	   $invoiceEntity = $invoiceDbEntry;
					   }
					   
	 				  // trying to understand how to pass $invoiceEntity through POST method (properly, passing an id), 
	 				  // I'm running out of time. I think it would be the proper way, so that the form could be
	 				  // refreshed by a redirect, right here.

			       }
				   
				  // show the inserted entity
		        return $this->render('@Invoices/Invoice/form.html.twig',array('form'=>$form->createView(),'invoiceEntity'=>$invoiceEntity));
		    }

			
}
			