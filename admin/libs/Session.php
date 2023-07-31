<?php

namespace Admin\Libs;

class Session
{
    private $signedIn = false;
    public $userId;
    public $role;
    public $message;

    public function __construct()
    {
        $this->checkLogin();
        $this->checkMessage();
    }

    public function isSignedIn()
    {
        return $this->signedIn;
    }

    public function checkLogin()
    {
        if (isset($_SESSION['userId'])) {
            $this->userId = $_SESSION['userId'];
            $this->role = $_SESSION['role'];
            $this->signedIn = true;
        } else {
            unset($this->userId);
            unset($this->role);
            $this->signedIn = false;
        }
    }

    public function login($user)
    {
        if ($user) {
            $this->userId = $user->getId();
            $_SESSION['userId'] = $user->getId();
            $this->role = $user->getRole();
            $_SESSION['role'] = $user->getRole();
            $this->signedIn = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['role']);
        unset($this->userId);
        unset($this->role);
        $this->signedIn = false;
    }

    public function message($msg = "")
    {
        if (!empty($msg)) {
            $this->message = $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    public function checkMessage()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
}
