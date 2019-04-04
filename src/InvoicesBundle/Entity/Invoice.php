<?php

namespace InvoicesBundle\Entity;

use InvoicesBundle\Entity\InvoiceData;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="InvoicesBundle\Repository\InvoiceRepository")
 */
class Invoice
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="invoiceDate", type="date")
     */
    private $invoiceDate;

    /**
     * @var int
     *
	 * @ORM\Column(name="invoiceNumber", type="integer", nullable=false)
	 * 
     */
    private $invoiceNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="customerId", type="integer")
     */
    private $customerId;

    /**
     * thought it could be conceptually correct the Invoice to have its invoiceData property.
	 * also useful in creating the form.
     *
     */
	
	protected $invoiceData;
	
	// create an InvoiceData instance when the Invoice is instantiated
    public function __construct()
    {
		$this->setInvoiceData(new InvoiceData);
    }
	
	//setter
    public function setInvoiceData($invoiceData)
    {
        $this->invoiceData = $invoiceData;

        return $this;
    }

	// a vehicle to set the invoice in InvoiceData. not sure about it... (see comments in InvoiceController)
    public function setInvoiceDataInvoice()
    {
        $this->invoiceData->setInvoice($this);

        return $this;
    }
	
	// as above, a vehicle to access to InvoiceData setter
    public function setInvoiceDataTotalAmount()
    {
        $this->invoiceData->setTotalAmount();

        return $this;
    }

    /**
     * Get invoiceData
     *
     * @return \invoiceData 
     */
	
    public function getInvoiceData()
    {
        return $this->invoiceData;
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set invoiceDate
     *
     * @param \DateTime $invoiceDate
     *
     * @return Invoice
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    /**
     * Get invoiceDate
     *
     * @return \DateTime
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * Set invoiceNumber
     *
     * @param integer $invoiceNumber
     *
     * @return Invoice
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Get invoiceNumber
     *
     * @return int
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     *
     * @return Invoice
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }
	
	
	
}
