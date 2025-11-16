<?php

namespace Arya\SistemPerpustakaan\Core;

class Controller {
    // Method to ensure session is started only once
    protected function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Method to render views
    protected function render($view, $data = []) {
        // Extract data to variables
        extract($data);
        
        // Include the view file
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "View not found: " . $viewPath;
        }
    }
    
    // Method to redirect to a URL
    protected function redirect($url) {
        // Ensure the URL is properly formatted
        if (!preg_match('~^https?://~', $url)) {
            // If it's a relative URL, make sure it starts with /
            if (substr($url, 0, 1) !== '/') {
                $url = '/' . $url;
            }
        }
        
        // Safety check: prevent redirect loops by checking if we're
        // redirecting to the same URL we're already on
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '';
        // Parse URLs to compare paths only, ignoring query parameters
        $currentPath = parse_url($currentUrl, PHP_URL_PATH);
        $redirectPath = parse_url($url, PHP_URL_PATH);
        
        if ($currentPath === $redirectPath && $currentPath !== null && $redirectPath !== null) {
            // Additional check to prevent infinite loops
            if (!isset($_SESSION['redirect_loop_count'])) {
                $_SESSION['redirect_loop_count'] = 0;
            }
            $_SESSION['redirect_loop_count']++;
            
            // If we've redirected to the same path more than 3 times, show an error
            if ($_SESSION['redirect_loop_count'] > 3) {
                // Reset the counter
                $_SESSION['redirect_loop_count'] = 0;
                // Show a simple error message instead of login form
                echo "Redirect loop detected. Please contact administrator.";
                exit();
            }
        } else {
            // Reset the counter when redirecting to a different path
            if (isset($_SESSION['redirect_loop_count'])) {
                unset($_SESSION['redirect_loop_count']);
            }
        }
        
        header('Location: ' . $url);
        exit();
    }
    
    // Method to check if user is authenticated
    protected function isAuthenticated() {
        $this->startSession();
        return isset($_SESSION['user']);
    }
    
    // Method to check if user is authenticated and redirect to login if not
    // while storing the original URL for redirect after login
    protected function requireAuth() {
        if (!$this->isAuthenticated()) {
            // Store the current URL for redirect after login
            $this->setSession('redirect_after_login', $_SERVER['REQUEST_URI']);
            $this->redirect('/login');
            return false;
        }
        return true;
    }
    
    // Method to get session data
    protected function getSession($key) {
        $this->startSession();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    
    // Method to set session data
    protected function setSession($key, $value) {
        $this->startSession();
        $_SESSION[$key] = $value;
    }
    
    // Method to destroy session
    protected function destroySession() {
        // Start session if not already started
        $this->startSession();
        
        // Unset all session variables
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
    }
    
    // Method to destroy session (alternative implementation)
    // protected function destroySession() {
    //     $this->startSession();
    //     session_destroy();
    //     // Also unset the session variable to ensure clean state
    //     $_SESSION = [];
    // }
}