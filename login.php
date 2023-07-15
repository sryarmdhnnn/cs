<!DOCTYPE html>
<?php
	include "cs/connection/koneksi.php";
	session_start();
	if(isset ($_SESSION['username'])){
		header('location: cs/beranda.php');
	} else {
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>LOGIN | EYDITH CAFE</title>
</head>
<body>
    <section>
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
        <div class="box">
            <div class="square" style="--i:0;"></div>
            <div class="square" style="--i:1;"></div>
            <div class="square" style="--i:2;"></div>
            <div class="square" style="--i:3;"></div>
            <div class="square" style="--i:4;"></div>
            <div class="container">
                <div class="form">
                    <h2>FORM LOGIN</h2>
                    <form>
                        <div class="inputBox">
                            <input type="text" placeholder="Username">
                        </div>
                        <div class="inputBox">
                            <input type="password" placeholder="Password">
                        </div>
                        <br>
                        <button name="login" class="btn btn-light btn-user btn-block">
                            Login
                        </button>
                        <p class="forget">Lupa Password? <a href="">Klik Disini</a></p>
                        <p class="forget">Tidak mempunyai akun? <a href="">Buat Akun</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
		if(isset ($_REQUEST['login'])){
			$arr_level = array();
			$c_level = mysqli_query($conn, "select * from tb_level");

			while($r = mysqli_fetch_array($c_level)){
				array_push($arr_level, $r['nama_level']);
			}
			foreach ($arr_level as $kontens) {
				//echo $kontens." || ";
			}
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];

			$akun = mysqli_query($conn, "select * from tb_user natural join tb_level");
			echo mysqli_error($conn);
			while($r = mysqli_fetch_array($akun)){
				if($r['username'] == $username and $r['password'] == $password and $r['status'] == 'aktif'){
					$_SESSION['username'] = $username;
					$_SESSION['id_user'] = $r['id_user'];
					$_SESSION['level'] = $r['id_level'];
					if(isset($_SESSION['eror'])){
						unset($_SESSION['eror']);
					}
					header('location: cs/beranda.php');
					//echo "<br>";
					//echo $r['username'] . " || " . $r['password'] . " || " . $r['id_level'] . " || " . $r['nama_level'];
					//echo "<br></br>";
					break;
				} else {
					$_SESSION['eror'] = 'salah';
					header('location: cs/index.php');
				}
			} 
		} 
	?>
</body>
</html>
<?php
	}
?>