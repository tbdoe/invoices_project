<?php

namespace InvoicesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class InvoiceDataType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		//still about the validator: I'm sure it would offer better ways to manage the required attributes. 
        $builder
			->add('description')
			->add('quantity', IntegerType::class, [
				    'attr' => [
				        'min' => 1,
				    ]])
			->add('amount', NumberType::class,
						['scale' => 2,])
			->add('vatAmount', IntegerType::class, [
				    'attr' => [
				        'min' => 0,
				        'max' => 100,
				    ]]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InvoicesBundle\Entity\InvoiceData'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'invoicesbundle_invoicedata';
    }


}
