<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "crm_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the customers and tasks arrays in the session if they don't exist
$_SESSION['customers'] = $_SESSION['customers'] ?? [];
$_SESSION['tasks'] = $_SESSION['tasks'] ?? [];

// Fetch customers from the database into session
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $_SESSION['customers'][$row['id']] = $row; // Store customers by ID
}

// Calculate task counts
$pending_count = 0;
$completed_count = 0;
foreach ($_SESSION['tasks'] as $task) {
    if ($task['status'] === 'pending') {
        $pending_count++;
    } elseif ($task['status'] === 'completed') {
        $completed_count++;
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_customer'])) {
        // Validate form inputs
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);

        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            die("All fields are required.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format.");
        }

        $profile_pic = 'default.jpg';
        if ($_FILES['profile_pic']['error'] == 0) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allowedExtensions)) {
                die("Only JPG, JPEG, PNG, and GIF files are allowed.");
            }
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                $profile_pic = basename($_FILES["profile_pic"]["name"]);
            } else {
                die("Error uploading file.");
            }
        }

        // Insert customer into the database
        $stmt = $conn->prepare("INSERT INTO customers (name, email, phone, address, profile_pic) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $phone, $address, $profile_pic);
        $stmt->execute();
        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['add_task'])) {
        $task_title = trim($_POST['task_title']);
        $task_description = trim($_POST['task_description']);
        $task_status = $_POST['task_status'];
        $customer_id = $_POST['customer_id'];

        if (empty($task_title) || !isset($_SESSION['customers'][$customer_id])) {
            die("Invalid task data.");
        }

        $new_task = [
            'title' => $task_title,
            'description' => $task_description,
            'status' => $task_status,
            'customer_id' => $customer_id
        ];
        $_SESSION['tasks'][] = $new_task; // Save task in session
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Fetch user from the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && $password === $user['password']) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['fullName'];
            $_SESSION['login_success'] = "Your login is successful"; // Set login success message
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['login_error'] = "Email or password is wrong"; // Error message for login
        }
    } elseif (isset($_POST['signup'])) {
        $fullName = trim($_POST['fullName']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirmPassword']);

        if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
            die("All fields are required.");
        }
        if ($password !== $confirmPassword) {
            die("Passwords do not match.");
        }
        if (strlen($password) < 6) {
            die("Password must be at least 6 characters long.");
        }

        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullName, $email, $password); // No hashing
        $stmt->execute();
        $stmt->close();
        $_SESSION['signup_success'] = true; // Set sign-up success message
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>alert('You have logged out');</script>"; // Alert on logout
    header("Location: http://localhost/projects"); // Redirect to your path
    exit();
}
?>