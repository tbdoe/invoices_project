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
    // /**
    //  * @Route("/invoice", name="invoice_home")
    //  */
    // public function indexAction()
    // {
    //     return $this->render('@Invoices/Invoice/index.html.twig');
    // }
		
	    /**
		     * @Route("/{invoiceEntity}", name="invoice_new")
	     */
	    public function addNewAction(Request $request, $invoiceEntity=null)
	    {

				$invoice = new Invoice();

				$form = $this->createForm(InvoiceType::class,$invoice);

				$form->handleRequest($request);


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

					   //passed to the view to be dumped
					   $insertedInvoiceId = $invoice->getId();
					   $invoiceDbEntry = $this->getDoctrine()
					           ->getRepository(Invoice::class)
					   		   ->find($insertedInvoiceId);

					   if($invoiceDbEntry){
					 	   $invoiceEntity = $invoiceDbEntry;
					   }
			       }
				   
				   
				  //refresh and show the inserted entity
		        return $this->render('@Invoices/Invoice/form.html.twig',array('form'=>$form->createView(),'invoiceEntity'=>$invoiceEntity));
		    }

			
}
			