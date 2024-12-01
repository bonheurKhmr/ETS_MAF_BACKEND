<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\MenuType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('icon')
            ->add('is_activated')
            ->add('orders')
            ->add('type', EntityType::class, [
                'class' => MenuType::class,
                'choice_label' => 'type',
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, $this->AddOtherInput(...))
        ;
    }

    public function AddOtherInput(PostSubmitEvent $event)
    {
        $data = $event->getData();
        if ( !($data instanceof Menu)) {
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
            'data_class' => Menu::class,
        ]);
    }
}
