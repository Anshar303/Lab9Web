<?php 
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$db = "latihan1"; 
$conn = mysqli_connect($host, $user, $pass, $db); 
// if ($conn == false) { 
//   echo "Koneksi ke server gagal."; 
//   die(); 
// } 
// else echo "Koneksi berhasil"; 

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


function hapus ($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM data_barang WHERE id_barang = $id");
    return mysqli_affected_rows($conn);
}



function ubah($data){
    global $conn;
    
    $id = $data["id_barang"];
    $nama = htmlspecialchars($data["nama"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $harga_jual = htmlspecialchars($data["harga_jual"]);
    $harga_beli = htmlspecialchars($data["harga_beli"]);
    $stok = htmlspecialchars($data["stok"]);
    $file_gambar = $data["file_gambar"];
    $gambar = null;
    if ($file_gambar['error'] == 0) {
      $filename = str_replace(' ', '_',$file_gambar['name']);
      $destination = dirname(__FILE__) .'/gambar/' . $filename;
        if(move_uploaded_file($file_gambar['tmp_name'], $destination)){
          $gambar =  $filename;
        }
    }
    $sql = "UPDATE data_barang SET 
            kategori = '$kategori', 
            nama = '$nama', 
            gambar = '$gambar', 
            harga_beli = '$harga_beli', 
            harga_jual = '$harga_jual', 
            stok = '$stok' 
            WHERE id_barang = $id";
    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
}
?>

