<?php

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["product_image"])) {
//     // Path file sementara yang diupload
//     $uploadedFile = $_FILES["product_image"]["tmp_name"];
    
//     // Pastikan file ada
//     if ($uploadedFile) {
//         // Encode gambar ke base64
//         $imageData = base64_encode(file_get_contents($uploadedFile));

//         // API Key dan Endpoint
//         $api_key = "tCYYYwQy5SoVRFxw1XUG";  // Ganti dengan API key Anda
//         $model_endpoint = "e-commerce-lvn2q/1";     // Ganti dengan endpoint model yang sesuai
        
//         // URL untuk request ke Roboflow
//         $url = "https://detect.roboflow.com/" . $model_endpoint
//             . "?api_key=" . $api_key
//             . "&name=" . urlencode($_FILES["product_image"]["name"]);

//         // Setup request menggunakan cURL
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//         curl_setopt($ch, CURLOPT_POST, 1);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, [
//             'file' => new CURLFile($uploadedFile),  // Menyertakan file
//         ]);

//         // Kirim request dan ambil respons
//         $response = curl_exec($ch);

//         // Cek error cURL
//         if (curl_errno($ch)) {
//             echo 'Error:' . curl_error($ch);
//         } else {
//             echo '<pre>' . json_encode(json_decode($response), JSON_PRETTY_PRINT) . '</pre>';
//         }

//         // Tutup koneksi cURL
//         curl_close($ch);
//     } else {
//         echo "No image uploaded.";
//     }
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["product_image"])) {
//     // Path file sementara yang diupload
//     $uploadedFile = $_FILES["product_image"]["tmp_name"];
    
//     // Pastikan file ada
//     if ($uploadedFile) {
//         // API Key dan Endpoint
//         $api_key = "tCYYYwQy5SoVRFxw1XUG";  // Ganti dengan API key Anda
//         $model_endpoint = "e-commerce-lvn2q/1";     // Ganti dengan endpoint model yang sesuai
        
//         // URL untuk request ke Roboflow
//         $url = "https://detect.roboflow.com/" . $model_endpoint
//             . "?api_key=" . $api_key
//             . "&name=" . urlencode($_FILES["product_image"]["name"]);

//         // Setup request menggunakan cURL
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//         curl_setopt($ch, CURLOPT_POST, 1);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, [
//             'file' => new CURLFile($uploadedFile),  // Menyertakan file
//         ]);

//         // Kirim request dan ambil respons
//         $response = curl_exec($ch);

//         // Cek error cURL
//         if (curl_errno($ch)) {
//             echo 'Error:' . curl_error($ch);
//         } else {
//             // Decode JSON response
//             $decodedResponse = json_decode($response, true);

//             // Periksa apakah 'predictions' ada dalam respons
//             if (isset($decodedResponse['predictions'][0]['class'])) {
//                 $class = $decodedResponse['predictions'][0]['class'];
//                 echo  $class;
//             } else {
//                 echo "No class detected or invalid response.";
//             }
//         }

//         // Tutup koneksi cURL
//         curl_close($ch);
//     } else {
//         echo "No image uploaded.";
//     }
// }

// // Mengambil category_id berdasarkan nama produk
// $query = "SELECT category_id FROM tabel_produk WHERE category_title = '$ch'";
// $result = mysqli_query($conn, $query); // Asumsi koneksi menggunakan mysqli

// if ($result && mysqli_num_rows($result) > 0) {
//     // Ambil category_id dari query result
//     $row = mysqli_fetch_assoc($result);
//     $category_id = $row['category_id'];

//     // Mengambil response sebelumnya (dari image search API)
//     // Pastikan response sudah ada sebelumnya
//     $json_response = json_decode($response, true);

//     // Asumsikan response JSON memiliki kategori
//     $category_from_image = $json_response['category'] ?? null;

//     // Jika kategori ditemukan, redirect ke halaman produk dengan category_id yang sesuai
//     if ($category_from_image) {
//         // Redirect dengan category_id dari database
//         header("Location: products.php?category=" . urlencode($category_id));
//         exit;
//     } else {
//         echo "Kategori tidak ditemukan.";
//     }
// } else {
//     echo "Produk tidak ditemukan.";
// }

include('./includes/connect.php');
include("./functions/common_functions.php");


global $con;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["product_image"])) { 
    // Path file sementara yang diupload
    $uploadedFile = $_FILES["product_image"]["tmp_name"];
    
    // Pastikan file ada
    if ($uploadedFile) {
        // API Key dan Endpoint
        $api_key = "tCYYYwQy5SoVRFxw1XUG";  // Ganti dengan API key Anda
        $model_endpoint = "e-commerce-lvn2q/1";     // Ganti dengan endpoint model yang sesuai
        
        // URL untuk request ke Roboflow
        $url = "https://detect.roboflow.com/" . $model_endpoint
            . "?api_key=" . $api_key
            . "&name=" . urlencode($_FILES["product_image"]["name"]);

        // Setup request menggunakan cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'file' => new CURLFile($uploadedFile),  // Menyertakan file
        ]);

        // Kirim request dan ambil respons
        $response = curl_exec($ch);

        // Cek error cURL
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            // Decode JSON response
            $decodedResponse = json_decode($response, true);

            // Periksa apakah 'predictions' ada dalam respons
            if (isset($decodedResponse['predictions'][0]['class'])) {
                $class = $decodedResponse['predictions'][0]['class'];
                echo  $class;
            } else {
                echo "No class detected or invalid response.";
            }
        }

        // Tutup koneksi cURL setelah selesai
        curl_close($ch);
    } else {
        echo "No image uploaded.";
    }
}

// Mengambil category_id berdasarkan nama produk
$query = "SELECT category_id FROM categories WHERE category_title = '$class';"; // Menggunakan $class yang terdeteksi dari image
$result = mysqli_query($con, $query); // Asumsi koneksi menggunakan mysqli

if ($result && mysqli_num_rows($result) > 0) {
    // Ambil category_id dari query result
    $row = mysqli_fetch_assoc($result);
    $category_id = $row['category_id'];

    // Redirect ke halaman produk dengan category_id yang sesuai
    header("Location: products.php?category=" . urlencode($category_id));
    exit;
} else {
    echo "Produk tidak ditemukan.";
}
echo  $class;


          



?>

