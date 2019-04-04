<?php

namespace InvoicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use InvoicesBundle\Entity\Invoice;

class DumpController extends Controller
{
    /**
     * @Route("/db_dump1", name="db_dump1")
	 * simply shows the result of an inner join
     */
    public function dumpInnerJoinAction()
    {
		$response = array();
		
		$conn = $this->get('database_connection');
		$query = "SELECT i.*, idt.* FROM invoice AS i INNER JOIN invoice_data as idt ON (i.id=idt.invoice_id)";	
		$response = $conn->fetchAll($query);

        return $this->render('@Invoices/Sql/dump.html.twig',array('db'=> $response));
    }
	
    /**
     * @Route("/db_dump2", name="db_dump2")
	 * a bit nicer dump to be read
     */
    public function indexAction()
    {
		
		$allTablesEntries = array();
		
		//retreives all datas from invoice_data table
		$conn = $this->get('database_connection');
		$invoicesDataEntries= $conn->fetchAll('select * from invoice_data');		

		if($invoicesDataEntries!=null){
			foreach($invoicesDataEntries as $invoicesDataEntry){
			   
			   //foreach row, get the corresponding invoice in invoice table
			   $invoiceEntry= $conn->fetchAll('select * from invoice WHERE id = '.$invoicesDataEntry["invoice_id"]);
			   //put the two rows as a pair in the array to be passed to the view
			   $allTablesEntries[] = array('invoice_entry' => $invoiceEntry[0], 'invoiceData_entry' => $invoicesDataEntry);

			}
		}
		
        return $this->render('@Invoices/Sql/dump2.html.twig',array('db'=> $allTablesEntries));
    }
}
