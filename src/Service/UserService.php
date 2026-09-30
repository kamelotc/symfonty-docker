<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Dto\User\UserRegisterInput;
use App\Dto\User\UserDetailsOutput;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Exception\User\EmailAlreadyUsedException;
use App\Service\Utils\AuditService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;



class UserService{
    public function __construct(

        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly AuditService $audit,
        private readonly LoggerInterface $logger,
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $hasher,

    ){

    }

    public function register(UserRegisterInput $input): User {

        if (null !== $this->users->findOneByEmail($input->email)) {
            $this->domainLogger->warning('registration conflict');

            throw new EmailAlreadyUsedException();
        }

        $user = new User()
            ->setEmail($input->email)
            ->setFirstName($input->firstName)
            ->setLastName($input->lastName);

        $password = $this->passwordHasher->hashPassword($user, $input->password);
        $user->setPassword($password);

        $this->audit->stampCreation($user);
        $this->userRepository->persist($user);
        $this->userRepository->flush();
        $this->domainLogger->info('user registered', ['id' => (string) $user->getId()]);

        return $user;
    }

    public function toDetails(User $user): UserDetailsOutput{
        return new UserDetailsOutput(
            (string) $user->getId(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getCreatedAt(),
        );
    }
}
