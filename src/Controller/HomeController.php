<?php

namespace App\Controller;

use App\Core\Controller;
use App\Repository\UserRepository;

class HomeController extends Controller
{
    public function index(): void
    {
        $userRepository = new UserRepository();
        $users = $userRepository->findAll();

        $this->render('home', [
            'title' => 'Page Home',
            'users' => $users
        ]);
    }
}
