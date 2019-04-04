<?php

namespace InvoicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InvoicesBundle\Entity\Invoice;

class DumpController extends Controller
{
    /**
     * @Route("/db_dump", name="db_dump")
     */
    public function indexAction()
    {
		
		$allTablesEntries = array();
		
		$conn = $this->get('database_connection');
		$invoicesDataEntries= $conn->fetchAll('select * from invoice_data');
		
		//check not null
		foreach($invoicesDataEntries as $invoicesDataEntry){
		   
		   $invoiceEntry= $conn->fetchAll('select * from invoice WHERE id = '.$invoicesDataEntry["invoice_id"]);
		   
		   $allTablesEntries[] = array('invoice_entry' => $invoiceEntry[0], 'invoiceData_entry' => $invoicesDataEntry);
			
		}
		
        return $this->render('@Invoices/Dump/dump.html.twig',array('db'=> $allTablesEntries));
    }
}
