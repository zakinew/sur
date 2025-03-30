
<!-- backend.php - الواجهة الخلفية --><?php
session_start();
$users = [
    "admin" => "1234",
    "user1" => "pass1"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if (isset($users[$username]) && $users[$username] == $password) {
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('بيانات تسجيل الدخول غير صحيحة.'); window.location.href='index.html';</script>";
    }
}
?><!-- dashboard.php - لوحة التحكم --><?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.html");
    exit();
}
?><!DOCTYPE html><html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        .container { max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="container">
        <h2>مرحبًا بك، <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
        <p>هذه لوحة التحكم الخاصة بك.</p>
        <a href="logout.php">تسجيل الخروج</a>
    </div>
</body>
</html><!-- logout.php - تسجيل الخروج --><?php
session_start();
session_destroy();
header("Location: index.html");
exit();
?>