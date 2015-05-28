<?php
include 'config.php';
$o1='<div class="navbar-form navbar-right">
					<div class="form-group">
						<input type="text" id="loglog" placeholder="login" class="form-control">
					</div>
					<div class="form-group">
						<input type="password" id="logpas" placeholder="hasło" class="form-control">
					</div>
					<button type="submit" class="btn btn-success" onclick="log_in();">Zaloguj</button>
				</div>';

function o2($login){
	echo'<div class="navbar-form navbar-right">
					<div class="form-group">
						<p style="color:#337ac6;margin:0px; padding:0px;  ">Zalogowany jako: <strong>'.$login.' <strong> </p>
					</div>
					<button type="submit" class="btn btn-success"  onclick="log_out();">Wyloguj</button>
				</div>';
}
$o3='<div class="navbar-form navbar-right">
					<div class="form-group">
						<p style="color:#337ac6;margin:0px; padding:0px;">Zły login lub hasło </p>
					</div>
					<div class="form-group">
						<input type="text" id="loglog" placeholder="login" class="form-control">
					</div>
					<div class="form-group">
						<input type="password" id="logpas" placeholder="hasło" class="form-control">
					</div>
					<button type="submit" class="btn btn-success" onclick="log_in();">Zaloguj</button>
				</div>';
				
if($_GET['op'] == 'check'){
	if($GLOBALS['zalogowany']){
		echo o2($_COOKIE['log']);
	}else{
		echo $o1;
	}
}elseif ($_GET['op'] == 'login'){
	if(isset($_GET['log'])){
		$query = "SELECT haslo FROM users WHERE login='".$_GET['log']."'";
		$result = $mysqli->query($query);
		$row = $result->fetch_assoc();	
		if($row["haslo"] == md5($_GET['pas']) && $result->num_rows > 0){
			setcookie("log", $_GET['log'], time()+3600*24*7,'');
			setcookie("pas", md5($_GET['pas']), time()+3600*24*7,'');
			echo o2($_GET['log']);
			$_SESSION['reload'] = true;
		}else{
			echo $o3;
		}
	}else{
		echo $o1;
	}
}elseif ($_GET['op'] == 'logout'){
	setcookie("log", 0, time()-1,'');
	setcookie("pas", 0, time()-1,'');
		@session_unset(); 
		@session_destroy();
		@session_write_close();
		@setcookie(session_name(),'',0,'/');
		@session_regenerate_id(true);
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	echo $o1;
}





















?>