<?php

namespace App\Controller;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('home', [
            'title' => 'Page Home',
            'description' => 'Voici une description',
            'age' => 54
        ]);
    }

    public function contact(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->render('contact', [
                'title' => 'Page Contact',
                'email' => $_POST['email'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message']
            ]);
            return;
        }

        $this->render('contact', [
            'title' => 'Page Contact'
        ]);
    }
}
