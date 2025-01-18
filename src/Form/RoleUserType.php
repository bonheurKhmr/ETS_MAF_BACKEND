<?php

namespace App\Form;

use App\Entity\RoleUser;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoleUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role')
            ->add('description')
            ->addEventListener(FormEvents::POST_SUBMIT, $this->AddOtherInput(...))
        ;
    }

    public function AddOtherInput(PostSubmitEvent $event)
    {
        $data = $event->getData();
        if ( !($data instanceof RoleUser)) {
            return;
        }
        $data->setName('ROLE_' . strtoupper($data->getRole()));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RoleUser::class,
        ]);
    }
}
