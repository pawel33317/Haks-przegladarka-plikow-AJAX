<?php
include 'schowekSession.php';
$tmp = false;
		if($GLOBALS['owner']){
	
			$query = "SELECT opis, haslo FROM folder WHERE link='".$GLOBALS['link']."'";
			$result = $mysqli->query($query);
			$row = $result->fetch_assoc();	
			$opiss="";
			$passwd="";
			if($result->num_rows > 0){
				if($row['opis'] != ''){
					$opiss=$row['opis'];
				}
				if($row['haslo'] != ''){
					$passwd='*******';
				}
			}
			
				echo '
				<div style="display:inline-block; width:50%; vertical-align:top;">
					<form id="upload_form" enctype="multipart/form-data" method="post">
						<span id="browseFile" style="display:inline-block; float:left; margin:10px;">
							<input type="file" data-input="false" data-buttonName="btn-primary" data-buttonText="&nbsp;Wybierz pliki" class="filestyle" name="upload[]" id="upload" multiple>
						</span>
						<div style="display:inline-block; margin:10px;">
							<input class="btn btn-primary btn-sm" type="button" value="Wrzuć" onclick="uploadFile()">
						</div>
						<div id="MbsProgressBar" class="progress" style="width:300px; margin:10px; display:none;">
							<div id="bsProgressBar" class="progress-bar progress-bar-striped " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
							0%<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<div id="status" class="alert alert-info" role="alert" onclick="$(this).hide();" style="margin:10px; display:none;"></div>
						
					</form>
					<div id="schowek" class="alert alert-info" role="alert" style="margin:10px; display:none;">';
					if(strlen(showSchowek())){
						echo '<button type="submit" style="margin-right:5px;margin-top:10px;" class="btn btn-primary" onclick="schowekClear();">Wyczyść</button>';
						echo'<button type="submit" style="margin-left:5px;margin-top:10px;" class="btn btn-primary" onclick="schowekSend(\''.$GLOBALS['link'].'\')">Przenieś tutaj</button>';
						echo'<button type="submit" style="margin-left:5px;margin-top:10px;" class="btn btn-primary" onclick="zipCreate(\''.$GLOBALS['link'].'\')">Utwórz archiwum ZIP</button>';
					};
					echo '</div>
					<div id="loaded_n_total" class="alert alert-info" role="alert" onclick="$(this).hide();" style="margin:10px; display:none;" ></div>
				</div>
				<div style="display:inline-block; padding:10px; width:48%; text-align:right;">
					
					<div class="form-inline">
						<div class="form-group has-warning">
							<input type="text" class="form-control" id="dirCreateName" name="dirCreateName" placeholder="nazwa katalogu">
						</div>
						<button type="submit" class="btn btn-warning"  style="width:25%; min-width:100px;" onclick="dirCreate();">Utwórz katalog</button>
					</div>
					<div class="form-inline" style="margin-top:10px;">
						<div class="form-group has-success">
							<input type="text" class="form-control" id="setopis" name="setopis" placeholder="Puste - brak opisu" value="'.$opiss.'">
						</div>
						<button type="submit"  style="width:25%; min-width:100px;"  class="btn btn-success" onclick="setopis();">Ustaw opis</button>
					</div>
					<div class="form-inline" style="margin-top:10px;">
						<div class="form-group has-error">
							<input type="text" class="form-control" id="setpassword" name="setpassword" placeholder="Puste - brak hasła" value="'.$passwd.'">
						</div>
						<button type="submit"  style="width:25%; min-width:100px;"  class="btn btn-danger" onclick="setpassword();">Ustaw hasło</button>
					</div>
				</div>
			';
		}
		else{
			echo 'Nie jesteś właścicielem katalogu.';
		}
?>