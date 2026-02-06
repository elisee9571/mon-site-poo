<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\EntityManager;
use App\Model\Contact;

class ContactController extends Controller
{
    public function contact(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = new Contact();

            $contact->setEmail($_POST['email'])
                ->setSubject($_POST['subject'])
                ->setMessage($_POST['message']);

            $entityManager = new EntityManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->redirect('/contact');
        }

        $this->render('contact', [
            'title' => 'Page Contact'
        ]);
    }
}
