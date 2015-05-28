<?php
include 'config.php';
$o1='<div class="list-group-item list-group-item-success">Rejestracja</div>
			<div class="list-group-item">
				<div>
					<div class="form-group">
						<label for="exampleInputEmail1">Login</label>
						<input type="email" class="form-control" id="reglog" placeholder="login">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Hasło</label>
						<input type="password" class="form-control" id="regpas" placeholder="hasło">
					</div>
					<button type="submit" class="btn btn-default" onclick="reg_try();">Zarejestruj</button>
				</div>
			</div>';

function o2($login){
	echo'<div class="list-group-item list-group-item-success">Użytkownik</div>
				<div class="list-group-item">
					<p style="padding:0px; margin:0px; color: #3c763d"><strong>'.$login.'</strong></p>
				</div>';
}
function o3($info){
echo'<div class="list-group-item list-group-item-success">Rejestracja</div>
			<div class="list-group-item">
				<div>
					<div class="form-group">
						<label style="color:red;">'.$info.'</label><br>
						<label for="exampleInputEmail1">Login</label>
						<input type="email" class="form-control" id="reglog" placeholder="login">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Hasło</label>
						<input type="password" class="form-control" id="regpas" placeholder="hasło">
					</div>
					<button type="submit" class="btn btn-default" onclick="reg_try();">Zarejestruj</button>
				</div>
			</div>';
}
function o4(){
	echo'<div class="list-group-item list-group-item-success">Rejestracja ukończona</div>
				<div class="list-group-item">
					<p style="padding:0px; margin:0px; color: #3c763d">Możesz się teraz zalogować</p>
				</div>';
}
if($GLOBALS['zalogowany']){
	echo o2($GLOBALS['user']);
}else{
	if(isset($_GET['log'])){
		$query = "SELECT id FROM users WHERE login='".$_GET['log']."'";
		$result = $mysqli->query($query);
		if($result->num_rows > 0){
			echo o3('Podany login jest już zajęty.'); 
			die();
		}
		elseif(strlen($_GET['log']) < 3){
			echo o3('Podany login jest zbyt krótki.'); 
			die();
		}
		elseif(strlen($_GET['pas']) < 3){
			echo o3('Podane hasło jest zbyt krótkie.'); 
			die();
		}else{
			$sql = "INSERT INTO users (login, haslo, ranga) VALUES ('".$_GET['log']."', '".md5($_GET['pas'])."', 0)";
			if ($mysqli->query($sql) === FALSE) {
				echo "Error: " . $mysqli->error.'<br>';
				die();
			}else{
				if(!file_exists($GLOBALS['main_folder'].'/'.$_GET['log'])){
					mkdir($GLOBALS['main_folder'].'/'.$_GET['log'], 0700);
					chmod($GLOBALS['main_folder'].'/'.$_GET['log'], 0777);
				}

				echo o4();
			}
		}
	}else{
		echo $o1;
	}
}





















?>