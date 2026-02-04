<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Database;

class HomeController extends Controller
{
    public function index(): void
    {
        $db = new Database();

        $query = $db->prepare("SELECT * FROM user");
        $query->execute();

        $user = $query->fetchAll();

        $this->render('home', [
            'title' => 'Page Home',
            'users' => $user
        ]);
    }

    public function contact(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new Database();

            $query = $db->prepare("INSERT INTO contact (email, subject, message) VALUES (:email, :subject, :message)");
            $query->execute([
                'email' => $_POST['email'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message']
            ]);

            $this->redirect('/contact');
        }

        $this->render('contact', [
            'title' => 'Page Contact'
        ]);
    }
}
