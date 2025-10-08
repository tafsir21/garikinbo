<?php
    // Database Config
    $host = 'localhost';
    $db   = 'car_auction';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Force MySQL to use Asia/Dhaka timezone
        $pdo->exec("SET time_zone = '+06:00'");
    } catch (PDOException $e) {
        die("DB connection failed: " . $e->getMessage());
    }

    // Force PHP to use Asia/Dhaka timezone
    date_default_timezone_set('Asia/Dhaka');

    // File Root
    $main_url = "http://localhost/bid";
    $get_api = "http://localhost/bid/api";
    define('ROOT_PATH', __DIR__ . '/');


    // Fetch user information
    $user = null;
    if (isset($_SESSION['user_id'])) {
            $stmt = $pdo->prepare("SELECT id, profile_pic_url, nid_verified, full_name, user_name, location, email, phone_number
                FROM users 
                WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    /**
     * Check if user is logged in.
     * If not, redirect to login page and exit.
     */
    function auth_check() {
        global $main_url; // Use $main_url from config
        if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
            header("Location: " . $main_url . "/auth/signin.php");
            exit;
        }
    }


    // Infinity Free Server Information
    // Domain: garikinbo.ct.ws
    // Pass: CUMIuJKRlF
    // User: if0_40122104
?>
