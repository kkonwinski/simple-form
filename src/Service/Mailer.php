<?php

namespace App\Service;

use App\Repository\SubjectRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class Mailer
{
    private MailerInterface $mailer;
    private SubjectRepository $subjectRepository;
    private string $emailTo;

    public function __construct(MailerInterface $mailer, SubjectRepository $subjectRepository, $emailTo)
    {
        $this->mailer = $mailer;
        $this->subjectRepository = $subjectRepository;
        $this->emailTo = $emailTo;
    }

    public function sendEmail(array $contactData): void
    {

        $subjectName = $this->subjectRepository->findOneBy(["id" => $contactData["subject"]]);
        $senderPersonalData = $contactData['name'] . " " . $contactData['lastName'];
        $email = (new Email())
            ->from(new Address($contactData["email"], $senderPersonalData))
            ->to($this->getEmailTo())
            ->subject($subjectName->getName())
            ->text($contactData['body'])
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }

    public function getEmailTo()
    {
        return $this->emailTo;
    }
}