<?php 
//koneksi ke database mysql, silahkan di rubah dengan koneksi agan sendiri 
$koneksi = mysqli_connect("localhost","root","","dbpenjumlahan"); 
  
//cek jika koneksi ke mysql gagal, maka akan tampil pesan berikut 
if (mysqli_connect_errno()){ 
 echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error(); 
} ?> 
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <h1>cobagit</h1>
	<form method="post">	
	nilai a <input type="text" name="a"><br>	
	nilai b<input type="text" name="b"><br>
	<input type="submit" name ="submit" value ="Hitung">
	</form>


	<?php
    //untuk menghitung 
	if(isset($_POST['submit'])){ 
	 	 	$a 	 	 	= $_POST['a']; 
	 	 	$b  	 	= $_POST['b']; 
	 	 	$c 			= $a+$b;
    if ($c >= 0 && $c <= 10) {$ket = 'A';}
    if ($c > 10 && $c <= 20) {$ket = 'B';}
    if ($c > 20) {$ket = 'C';}
    if ($c < 0) {$ket = 'D';}

		 
 	 	 	 	$sql = mysqli_query($koneksi, "INSERT INTO tbpenjumlahan(a,b,c,ket) 	VALUES('$a','$b','$c','$ket')") 	or die(mysqli_error($koneksi)); 
 	 	 	 	 
 	 	 	 
}
	?>
<br>
<br>
<br><table border="1">
	<tr>
		<th>ID</th>
		<th>a</th>
		<th>b</th>
		<th>c</th>
		<th>Ket</th>
	</tr>
	 <?php 
    //query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar 
    $sql = mysqli_query($koneksi, "SELECT * FROM tbpenjumlahan ORDER BY id ASC") or die(mysqli_error($koneksi)); 
                                //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if... 
                                if(mysqli_num_rows($sql) > 0){ 
                                        //membuat variabel $no untuk menyimpan nomor urut 
                                        
                                        //melakukan perulangan while dengan dari dari query 
                                        while($data = mysqli_fetch_assoc($sql)){ 
                                                //menampilkan data perulangan 
                                                echo ' <tr> 
                                                        <td>'.$data['id'].'</td> 
                                                        <td>'.$data['a'].'</td> 
                                                        <td>'.$data['b'].'</td> 
                                                        <td>'.$data['c'].'</td>  
                                                        <td>'.$data['ket'].'</td>  
                                                    </tr>'; 
                                                
                                        } 
                                //jika query menghasilkan nilai 0 
                                }else{                                  echo ' 
                                        <tr> 
                                                <td colspan="6">Tidak ada data.</td> 
                                        </tr> 
                                        '; 
                                } 
                                ?> 

</table>
</body>
</html>