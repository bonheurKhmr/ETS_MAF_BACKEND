<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\SousMenu;
use Doctrine\ORM\QueryBuilder;
use App\Repository\MenuRepository;
use App\Repository\MenuTypeRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SousMenuType extends AbstractType
{
    public function __construct(
        readonly private MenuTypeRepository $menuTypeRepository
    ) {}
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('is_activated')
            ->add('see_more')
            ->add('orders', NumberType::class)
            ->add('direction')
            ->add('icon', TextareaType::class, ["required" => false])
            ->add('menu', EntityType::class, [
                'class' => Menu::class,
                'choice_label' => 'label',
                'query_builder' => function (MenuRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('m')
                        ->andWhere('m.type = ' . $this->menuTypeRepository->findOneBy(['type' => 'frontend navbar'])->getId())
                        ->andWhere('m.is_activated = 1')
                        ->orderBy('m.orders', 'ASC');
                },
            ])
            ->add('sousMenuImages', CollectionType::class, [
                'entry_type' => SousMenuImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'entry_options' => ['label' => false],
                'attr' => [
                    'data-controller' => 'form-collection'
                ]
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, $this->AddOtherInput(...))
        ;
    }

    public function AddOtherInput(PostSubmitEvent $event)
    {
        $data = $event->getData();
        if ( !($data instanceof SousMenu)) {
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
            'data_class' => SousMenu::class,
        ]);
    }
}
