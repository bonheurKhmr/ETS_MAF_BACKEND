<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\MenuType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('name', TextType::class, ["required" => false])
            ->add('link', TextType::class, ["required" => false])
            ->add('description', TextareaType::class, ["required" => false])
            ->add('icon', TextareaType::class, ["required" => false])
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

        if (! $data->getIcon() || $data->getIcon() === null) {
            $data->setIcon('<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" viewBox="0 0 16 16"><circle cx="8" cy="8" r="8"/></svg>
            ');
        }

        if (! $data->getDescription() || $data->getDescription() === null) {
            $data->setDescription('description pour ' . $data->getLabel());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
