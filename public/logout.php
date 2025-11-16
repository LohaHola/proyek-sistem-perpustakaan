<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Arya\SistemPerpustakaan\Core\Controller;

class LogoutHandler extends Controller {
    public function handle() {
        // Start session
        $this->startSession();
        
        // Clear all session data
        $_SESSION = array();
        
        // Delete session cookie if it exists
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Destroy the session
        session_destroy();
        
        // Redirect to login page
        $this->redirect('/login');
    }
}

// Handle logout
$logoutHandler = new LogoutHandler();
$logoutHandler->handle();