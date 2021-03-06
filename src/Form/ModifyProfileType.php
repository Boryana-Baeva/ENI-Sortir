<?php
//comment
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ModifyProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'disabled' => true,
                'required' => false
            ])
            ->add('firstName', TextType::class, [
                'required'=> false
            ])
            ->add('lastName', TextType::class, [
                'required'=> false
            ])
            ->add('phoneNumber', TextType::class, [
                'required'=> false
            ])
            ->add('email', EmailType::class,[
                'disabled'=> true,
                'required'=> false
            ])
            ->add('newPassword', RepeatedType::class , [
                'type' => PasswordType::class,
                'mapped' => false,
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'invalid_message' => 'The password fields must match.',
                'required' => false,
                'first_options' => array('label'=> 'New Password'),
                'second_options' => array('label'=> 'Repeat New Password'),
            ])
            ->add('campus', EntityType::class, [
                'class'=>'App\Entity\Campus',
                'choice_label'=>'name',
                'required'=>false
            ])
            ->add('picture', FileType::class, [
                'label'=>'Upload avatar',
                'mapped'=>false,
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
