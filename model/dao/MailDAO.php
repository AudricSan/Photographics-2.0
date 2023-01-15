<?php

use photographics\Mail;
use photographics\Env;

class MailDAO extends Env
{
    public function __construct()
    {
    }

    public function create($result)
    {
        if (!$result) {
            return false;
        }

        // NOTE DUMP OF OBJECT CREATE
        // var_dump($result);
        return new Mail(
            $result['to'],
            $result['subject'],
            $result['message'],
            $result['add-headers'],
            $result['add_params']
        );
    }

    public function send($to, $data)
    {
        if (empty($data)) {
            return false;
        }

        $mail = $data['mail'];
        $sender = "From: $mail";

        $mail = $this->create([
            'to'          => $to,
            'subject'     => $data['sujet'],
            'message'     => $data['message'],
            'add-headers' => $sender,
            'add_params'  => ''
        ]);

        if ($mail) {
            try {
                mail(
                    $mail->_to,
                    $mail->_subject,
                    $mail->_message,
                    $mail->_additional_headers,
                    $mail->_additional_params
                );
            } catch (PDOException $e) {
                var_dump($e->getMessage());
            }
        }

        header('location: /contact');
    }
}
