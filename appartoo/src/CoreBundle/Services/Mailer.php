<?php

namespace CoreBundle\Services;
use Symfony\Component\Templating\EngineInterface;

class Mailer
{
    protected $mailer;

    protected $templating;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;

        $this->templating = $templating;
    }

    public function sendContactMessage($fromMe, $to)
    {
        $template = 'CoreBundle:Emails:sendmailer.txt.twig';

        $from = "no-reply@gmail.fr";

        $subject = 'Contact appartoo';

        $body = $this->templating->render($template, array('username' => $fromMe));

        $this->sendMessage($from, $to, $subject, $body);
    }

    protected function sendMessage($from, $to, $subject, $body)
    {
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body);

        $this->mailer->send($mail);
    }
}