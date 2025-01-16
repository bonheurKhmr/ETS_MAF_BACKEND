<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\EntrepriseContent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\UX\Dropzone\Form\DropzoneType;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('litle_name')
            ->add('logoFile', DropzoneType::class, ["required" => false])
            ->add('activated')
            ->add('rccm')
            ->add('pays')
            ->add('province')
            ->add('vile')
            ->add('commune')
            ->add('avenue')
            ->addEventListener(FormEvents::POST_SUBMIT, $this->AddOtherInput(...))
        ;
    }

    public function AddOtherInput(PostSubmitEvent $event)
    {
        $data = $event->getData();
        if ( !($data instanceof Entreprise)) {
            return;
        }

        $data->setUpdatedAt(new \DateTimeImmutable());
        if (! $data->getId()) {
            $data->setCreatedAt(new \DateTimeImmutable());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}