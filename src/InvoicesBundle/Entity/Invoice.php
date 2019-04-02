<?php

namespace InvoicesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use InvoicesBundle\Entity\InvoiceData;
use Doctrine\ORM\Mapping as ORM;

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
	 * @ORM\Column(name="invoiceNumber", type="integer")
     */
    private $invoiceNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="customerId", type="integer")
     */
    private $customerId;

    /**
     * 
     *
	 * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToOne(targetEntity="InvoiceData", inversedBy="invoiceId")
     * @ORM\JoinColumn(name="InvoiceData", referencedColumnName="id", nullable=false)
     */
	
	protected $invoiceData;
	
	protected $invoicesCollection;
	
    public function __construct()
    {
        $this->invoicesCollection = new ArrayCollection();
		$this->setInvoiceData(new InvoiceData);
    }
	
    public function getinvoicesCollection()
    {
        return $this->invoicesCollection;
    }
	
	
    public function setInvoiceData($invoiceData)
    {
        $this->invoiceData = $invoiceData;

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
