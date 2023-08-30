<?php

namespace Admin\Libs;

require_once 'Session.php'; // Include your Session class file

class AccessControl
{
    public static function checkAccess($allowedRoles)
    {
        $session = new Session();

        

        if (!$session->isSignedIn()) {
            header("Location: /index.php"); // Redirect to index if not signed in
            exit;
        }

        $userRole = $session->role;

        if (!in_array($userRole, $allowedRoles)) {
            header("Location: access_denied.php");
            exit;
        }
    }
}
