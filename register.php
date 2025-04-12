<?php
session_start();
require_once 'config.php';

if(isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$error = '';
$success = '';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Silakan isi semua field";
    } elseif($password !== $confirm_password) {
        $error = "Password tidak cocok";
    } else {
        // Cek username sudah ada atau belum
        $check_username = "SELECT id FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($conn, $check_username)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) > 0) {
                $error = "Username sudah digunakan";
            } else {
                // Cek email sudah ada atau belum
                $check_email = "SELECT id FROM users WHERE email = ?";
                if($stmt = mysqli_prepare($conn, $check_email)) {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) > 0) {
                        $error = "Email sudah digunakan";
                    } else {
                        // Insert user baru
                        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                        if($stmt = mysqli_prepare($conn, $sql)) {
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);
                            
                            if(mysqli_stmt_execute($stmt)) {
                                $success = "Registrasi berhasil! Silakan login.";
                            } else {
                                $error = "Terjadi kesalahan. Silakan coba lagi.";
                            }
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
            }
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - GameTopup</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animasi background */
        body::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(74,144,226,0.1) 0%, rgba(0,255,136,0.1) 100%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .register-container {
            background: rgba(26, 26, 26, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            position: relative;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .register-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #4a90e2, #00ff88);
            border-radius: 3px;
        }

        .register-header h1 {
            color: #4a90e2;
            font-size: 32px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .register-header p {
            color: #ccc;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #ccc;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #333;
            border-radius: 10px;
            background: rgba(45, 45, 45, 0.8);
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        }

        .form-group input:focus + label {
            color: #4a90e2;
        }

        .register-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #4a90e2, #00ff88);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .error-message {
            background: rgba(255, 0, 0, 0.1);
            color: #ff4444;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid rgba(255, 0, 0, 0.2);
            animation: shake 0.5s ease-in-out;
        }

        .success-message {
            background: rgba(0, 255, 0, 0.1);
            color: #00ff88;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid rgba(0, 255, 0, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .login-link a {
            color: #4a90e2;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .login-link a:hover {
            color: #00ff88;
            text-shadow: 0 0 10px rgba(0,255,136,0.3);
        }

        .back-home {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            padding: 10px 20px;
            background: rgba(255,255,255,0.1);
            border-radius: 25px;
            backdrop-filter: blur(5px);
        }

        .back-home:hover {
            color: #4a90e2;
            background: rgba(74,144,226,0.1);
            transform: translateX(-5px);
        }

        .social-register {
            margin-top: 30px;
            text-align: center;
        }

        .social-register p {
            color: #ccc;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-icons a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.1);
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background: #4a90e2;
            transform: translateY(-3px);
        }

        @media (max-width: 480px) {
            .register-container {
                margin: 20px;
                padding: 30px;
            }

            .back-home {
                top: 10px;
                left: 10px;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <a href="index.html" class="back-home">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>

    <div class="register-container">
        <div class="register-header">
            <h1>Register</h1>
            <p>Buat akun GameTopup baru</p>
        </div>

        <?php if(!empty($error)): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if(!empty($success)): ?>
            <div class="success-message">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="register-btn">Daftar</button>
        </form>

        <div class="social-register">
            <p>Atau daftar dengan</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-google"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <div class="login-link">
            Sudah punya akun? <a href="login.php">Masuk disini</a>
        </div>
    </div>
</body>
</html> 