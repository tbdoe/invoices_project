<?php

namespace InvoicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceData
 *
 * @ORM\Table(name="invoice_data")
 * @ORM\Entity(repositoryClass="InvoicesBundle\Repository\InvoiceDataRepository")
 */
class InvoiceData
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
	 * @ORM\Column(name="invoiceId", type="integer", unique=true, nullable=false)
     * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
     */
	
    private $invoiceId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=12, scale=2)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="vatAmount", type="decimal", precision=12, scale=2)
     */
    private $vatAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="totalAmount", type="decimal", precision=12, scale=2)
     */
    private $totalAmount;


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
     * Set invoiceId
     *
     * @param integer $invoiceId
     *
     * @return InvoiceData
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * Get invoiceId
     *
     * @return int
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return InvoiceData
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return InvoiceData
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return InvoiceData
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set vatAmount
     *
     * @param string $vatAmount
     *
     * @return InvoiceData
     */
    public function setVatAmount($vatAmount)
    {
		$amount = $this->getAmount();
		
		$this->vatAmount = ($amount != null) ? round((($vatAmount / 100) * $amount),2) : $vatAmount;;
        
        return $this;
    }

    /**
     * Get vatAmount
     *
     * @return string
     */
    public function getVatAmount()
    {
        return $this->vatAmount;
    }

    /**
     * Set totalAmount
     *
     * @param string 
     *
     * @return InvoiceData
     */
    public function setTotalAmount()
    {
        $this->totalAmount = round(($this->vatAmount + $this->amount),2);

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return string
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return InvoiceData
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
	
}
