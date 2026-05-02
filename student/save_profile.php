<?php
include('../config/db.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAjax = (
   (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
   || (isset($_POST['ajax']) && $_POST['ajax'] === '1')
   || (!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
);

if (!isset($_SESSION['email'])) {
   if ($isAjax) {
      http_response_code(401);
      header('Content-Type: application/json');
      echo json_encode(['ok' => false, 'message' => 'Not logged in']);
      exit();
   }
   header('Location: login.php');
   exit();
}

$email = $_SESSION['email'];

function ensureImageColumnExists(mysqli $conn): bool {
   $check = $conn->query("SHOW COLUMNS FROM students LIKE 'image'");
   if ($check && $check->num_rows > 0) {
      return true;
   }

   $alter = $conn->query("ALTER TABLE students ADD COLUMN image VARCHAR(255) NULL");
   return (bool)$alter;
}

$setParts = [];
$params = [];
$types = '';

/* NAME */
if (isset($_POST['name'])) {
   $name = trim((string)$_POST['name']);
   $setParts[] = 'name = ?';
   $params[] = $name;
   $types .= 's';
}

/* SKILLS */
if (isset($_POST['skills'])) {
   $skills = (string)$_POST['skills'];
   $skillsArray = array_map('trim', explode(',', $skills));
   $skillsArray = array_filter($skillsArray, function ($s) {
      return $s !== '';
   });
   $finalSkills = implode(', ', array_unique($skillsArray));

   $setParts[] = 'skills = ?';
   $params[] = $finalSkills;
   $types .= 's';
}

/* INTERESTS */
if (isset($_POST['interests'])) {
   $interests = trim((string)($_POST['interests'] ?? ''));
   $setParts[] = 'interests = ?';
   $params[] = $interests;
   $types .= 's';
}

/* GPA */
if (array_key_exists('gpa', $_POST)) {
   $gpaRaw = trim((string)$_POST['gpa']);
   if ($gpaRaw === '') {
      $setParts[] = 'gpa = NULL';
   } else {
      $gpa = (float)$gpaRaw;
      $setParts[] = 'gpa = ?';
      $params[] = $gpa;
      $types .= 'd';
   }
}

/* PROFILE IMAGE */
if (isset($_FILES['profile_image']) && isset($_FILES['profile_image']['error'])) {
   if ($_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
      $tmpName = $_FILES['profile_image']['tmp_name'];
      $size = (int)($_FILES['profile_image']['size'] ?? 0);

      if ($size > 2 * 1024 * 1024) {
         if ($isAjax) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['ok' => false, 'message' => 'Image too large (max 2MB)']);
            exit();
         }
         die('Image too large (max 2MB)');
      }

      $ext = '';
      if (class_exists('finfo')) {
         $finfo = new finfo(FILEINFO_MIME_TYPE);
         $mime = $finfo->file($tmpName);

         $allowed = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp'
         ];

         if (isset($allowed[$mime])) {
            $ext = $allowed[$mime];
         }
      }

      if ($ext === '') {
         $originalExt = strtolower(pathinfo($_FILES['profile_image']['name'] ?? '', PATHINFO_EXTENSION));
         $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
         if (in_array($originalExt, $allowedExt, true)) {
            $ext = ($originalExt === 'jpeg') ? 'jpg' : $originalExt;
         }
      }

      if ($ext === '') {
         if ($isAjax) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['ok' => false, 'message' => 'Unsupported image type']);
            exit();
         }
         die('Unsupported image type');
      }
      $fileName = bin2hex(random_bytes(16)) . '.' . $ext;
      $uploadDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_images';

      if (!is_dir($uploadDir)) {
         @mkdir($uploadDir, 0777, true);
      }

      $destPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
      if (!move_uploaded_file($tmpName, $destPath)) {
         if ($isAjax) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['ok' => false, 'message' => 'Failed to save uploaded image']);
            exit();
         }
         die('Failed to save uploaded image');
      }

      if (!ensureImageColumnExists($conn)) {
         if ($isAjax) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['ok' => false, 'message' => "Database missing 'image' column (could not add automatically)" ]);
            exit();
         }
         die("Database missing 'image' column (could not add automatically)");
      }

      $relativePath = 'uploads/profile_images/' . $fileName;
      $setParts[] = 'image = ?';
      $params[] = $relativePath;
      $types .= 's';
   } elseif ($_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE) {
      if ($isAjax) {
         http_response_code(400);
         header('Content-Type: application/json');
         echo json_encode(['ok' => false, 'message' => 'Image upload failed']);
         exit();
      }
      die('Image upload failed');
   }
}

if (!empty($setParts)) {
   $sql = 'UPDATE students SET ' . implode(', ', $setParts) . ' WHERE email = ?';
   $stmt = $conn->prepare($sql);
   if (!$stmt) {
      if ($isAjax) {
         http_response_code(500);
         header('Content-Type: application/json');
         echo json_encode(['ok' => false, 'message' => 'Failed to prepare query']);
         exit();
      }
      die('Failed to prepare query');
   }

   $types .= 's';
   $params[] = $email;
   $stmt->bind_param($types, ...$params);
   $stmt->execute();
   $stmt->close();
}

if ($isAjax) {
   header('Content-Type: application/json');
   echo json_encode(['ok' => true]);
   exit();
}

header('Location: dashboard.php?success=1');
exit();
?>