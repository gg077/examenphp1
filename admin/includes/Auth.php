
<!--Het in gang krijgen van user / admin... kwam in een knop terecht en geraakte er niet meer uit...-->
<!--Het in gang krijgen van user / admin... kwam in een knop terecht en geraakte er niet meer uit...-->
<!--Het in gang krijgen van user / admin... kwam in een knop terecht en geraakte er niet meer uit...-->

<?php

class Auth
{
    public static function requireAdmin() {
        global $session;

        if (!$session->is_signed_in()) {
            header("Location: ../login.php");
            exit;
        }

        if (!isset($session->user->role) || $session->user->role !== 'admin') {
            header("Location: ../index.php");
            exit;
        }
    }

    public static function isAdmin() {
        global $session;
        return $session->is_signed_in() && isset($session->user->role) && $session->user->role === 'admin';
    }

    public static function requireUser() {
        global $session;

        if (!$session->is_signed_in()) {
            header("Location: ../login.php");
            exit;
        }

        if (!isset($session->user->role) || $session->user->role !== 'user') {
            header("Location: ../index.php");
            exit;
        }
    }
}
?>



