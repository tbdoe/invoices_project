<?php

namespace InvoicesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use InvoicesBundle\Form\InvoiceDataType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InvoiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		//still about the validator: I'm sure it would offer better ways to manage the required attributes.
        $builder
			->add('invoiceDate', DateType::class, [
				'widget' => 'single_text',
            ])
			->add('invoiceNumber', IntegerType::class, [
				    'attr' => [
				        'min' => 1,
				    ]])
			->add('customerId', IntegerType::class, [
				    'attr' => [
				        'min' => 1,
				    ]])
			->add('invoiceData',InvoiceDataType::class)
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
