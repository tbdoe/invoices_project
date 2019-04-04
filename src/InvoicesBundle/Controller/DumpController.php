<?php

namespace InvoicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DumpController extends Controller
{
    /**
     * @Route("/db_dump", name="db_dump")
     */
    public function indexAction()
    {
		
		$conn = $this->get('database_connection');
		//run a query
		$invoices= $conn->fetchAll('select * from invoice');
		
		$invoicesData= $conn->fetchAll('select * from invoice_data');
		
        return $this->render('@Invoices/Dump/dump.html.twig',array('db'=>array('invoices' => $invoices, 'invoicesData'=>$invoicesData)));
    }
}
