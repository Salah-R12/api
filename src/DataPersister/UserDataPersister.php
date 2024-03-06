<?php
namespace App\DataPersister;

use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserDataPersister implements ProcessorInterface
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function supports(mixed $data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if ($data instanceof User && ($context['collection_operation_name'] ?? null) === 'post') {
            $encodedPassword = $this->passwordHasher->hashPassword($data, $data->getPassword());
            $data->setPassword($encodedPassword);
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}
