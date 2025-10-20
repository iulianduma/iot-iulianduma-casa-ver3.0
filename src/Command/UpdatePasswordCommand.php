<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:update-password')]
class UpdatePasswordCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED);
        $this->addArgument('plainPassword', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->em->getRepository(User::class)->findOneBy([
            'email' => $input->getArgument('email')
        ]);

        if (!$user) {
            $output->writeln('User not found.');
            return Command::FAILURE;
        }

        $hashed = $this->hasher->hashPassword($user, $input->getArgument('plainPassword'));
        $user->setPassword($hashed);
        $this->em->flush();

        $output->writeln('Password updated.');
        return Command::SUCCESS;
    }
}
