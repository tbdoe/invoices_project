<?php

namespace InvoicesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use InvoicesBundle\Form\InvoiceDataType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InvoiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('invoiceDate')
			->add('invoiceNumber')
			->add('customerId')
			//->add('invoiceData',InvoiceDataType::class)
			->add('invoicesCollection', CollectionType::class, [
					'entry_type' => InvoiceDataType::class,
					'allow_add' => true,
					'entry_options' => ['label' => false],
					        ])
			->add('Add',SubmitType::class);
			
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InvoicesBundle\Entity\Invoice'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'invoicesbundle_invoice';
    }


}
