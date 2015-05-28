<!DOCTYPE html>
<?php
	include 'php/config.php';
	
	/*****************************************************************************************
	****************EDYCJA PLIKÓW*************************************************************
	****************NOWE DI BAZY I WYSWIETLAC W MENU******************************************
	******************************************************************************************
	******************************************************************************************
	******************************************************************************************
	****************ZABLOKOWAC JESLI NIE ADMIN************************************************
	****************-upload*******************************************************************
	****************-tworzenie katalogu*******************************************************
	****************-zmien nazwę**************************************************************
	****************-usuń*********************************************************************
	****************-przenieś*****************************************************************
	****************-utwórz zip w innym*******************************************************
	******************************************************************************************
	******************************************************************************************
	******************************************************************************************
	******************************************************************************************
	******************************************************************************************
	******************************************************************************************
	******************************************************************************************
	******************************************************************************************
	******************************************************************************************
	******************************************************************************************/
?>
<html>
<head>
	<link rel="stylesheet" href="style/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="style/mystyle.css">
	<script src="style/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="style/bootstrap/js/bootstrap-filestyle.min.js"></script>
	
	<meta charset="utf-8" />
	<script src="style/bootstrap/js/bootstrap.min.js"></script>
	<link rel="Shortcut icon" href="style/favi.png" />
    <title>Haks.pl - file browser</title>

	<script>
		function reg_check(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if (xmlhttp.responseText.length){
						_("registerid").innerHTML = xmlhttp.responseText;
					}
				}
			}
			xmlhttp.open("GET","php/register.php");
			xmlhttp.send();
		}
		function reg_try(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if (xmlhttp.responseText.length){
						_("registerid").innerHTML = xmlhttp.responseText;
					}
				}
			}
			xmlhttp.open("GET","php/register.php?log="+_("reglog").value+"&pas="+_("regpas").value);
			xmlhttp.send();
		}
		
		function log_check(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if (xmlhttp.responseText.length){
						_("navbar").innerHTML = xmlhttp.responseText;
						loadFiles(); 
					}
				}
			}
			xmlhttp.open("GET","php/login.php?op=check");
			xmlhttp.send();
		}
	
		function log_in(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if (xmlhttp.responseText.length){
						_("navbar").innerHTML =xmlhttp.responseText;
						loadFiles();reg_check();filefooter();
					}
				}
			}
			xmlhttp.open("GET","php/login.php?op=login&log="+_("loglog").value+"&pas="+_("logpas").value,true);
			xmlhttp.send();
		}
		function log_out(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if (xmlhttp.responseText.length){
						_("navbar").innerHTML = xmlhttp.responseText;
						loadFiles();reg_check();filefooter();
					}
				}
			}
			xmlhttp.open("GET","php/login.php?op=logout",true);
			xmlhttp.send();
		}
		/*function schowekCheck(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if (xmlhttp.responseText.length){
						$("#schowek").show();
						_("schowek").innerHTML = '<strong>Schowek:</strong><br>';
						_("schowek").innerHTML =_("schowek").innerHTML+xmlhttp.responseText;
						_("schowek").innerHTML =_("schowek").innerHTML+'<button type="submit" style="margin-right:5px;margin-top:10px;" class="btn btn-primary" onclick="schowekClear();">Wyczyść</button>';
						_("schowek").innerHTML =_("schowek").innerHTML+'<button type="submit" style="margin-left:5px;margin-top:10px;" class="btn btn-primary" onclick="schowekSend(\'<?php echo $GLOBALS['link'];?>\')">Przenieś tutaj</button>';
						_("schowek").innerHTML =_("schowek").innerHTML+'<button type="submit" style="margin-left:5px;margin-top:10px;" class="btn btn-primary" onclick="zipCreate(\'<?php echo $GLOBALS['link'];?>\')">Utwórz archiwum ZIP</button>';
						//loadFiles();
					}
				}
			}
			xmlhttp.open("GET","php/schowekSession.php?op=show",true);
			xmlhttp.send();
		}*/
		function schowekAdd(newItemName, newItemLocation){
			if(newItemLocation=="undefined" || newItemLocation=="" ){
				//newItemLocation='/';
			}else{
				newItemLocation=newItemLocation+'/';
			}
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					$("#schowek").show();
					_("schowek").innerHTML = '<strong>Schowek:</strong><br>';
					_("schowek").innerHTML =_("schowek").innerHTML+xmlhttp.responseText;
					_("schowek").innerHTML =_("schowek").innerHTML+'<button type="submit" style="margin-right:5px;margin-top:10px;" class="btn btn-primary" onclick="schowekClear();">Wyczyść</button>';
					_("schowek").innerHTML =_("schowek").innerHTML+'<button type="submit" style="margin-left:5px;margin-top:10px;" class="btn btn-primary" onclick="schowekSend(\'<?php echo $GLOBALS['link'];?>\');">Przenieś tutaj</button>';
					_("schowek").innerHTML =_("schowek").innerHTML+'<button type="submit" style="margin-left:5px;margin-top:10px;" class="btn btn-primary" onclick="zipCreate(\'<?php echo $GLOBALS['link'];?>\')">Utwórz archiwum ZIP</button>';
					loadFiles();
				}
			}
			xmlhttp.open("GET","php/schowekSession.php?op=add&file="+newItemLocation+newItemName,true);
			xmlhttp.send();
		}
				
		var schowekLista = [ ];

		function _(el){
					return document.getElementById(el);
				}
		function Round(n, k){
			var factor = Math.pow(10, k);
			return Math.round(n*factor)/factor;
		}
		function uploadFile(){
			var formdata = new FormData();
			if (_("upload").files.length == 0){
				alert("Brak plików");
				_("browseFile").innerHTML = '<input type="file" class="filestyle" name="upload[]" id="upload" multiple>';
				$(":file").filestyle({buttonText: "&nbsp;Brak plików", buttonName: "btn-primary", input: false});
				return;
			}
			$("#MbsProgressBar").show();
			for ( i = 0; i < _("upload").files.length; i++) { 
				formdata.append("upload[]", _("upload").files[i]);
			}
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandler, false);
			ajax.addEventListener("load", completeHandler, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			ajax.open("POST", "php/file_upload_parser.php?link="+getUrlParameter('link'));
			ajax.send(formdata);
		}
		function progressHandler(event){
			var loadedd = Round(event.loaded/(1024*1024),2);
			var allload = Round(event.total/(1024*1024),2);
			$("#loaded_n_total").show();
			_("loaded_n_total").innerHTML = 'Wrzucono '+loadedd+' z '+allload+' MB.';
			var percent = (event.loaded / event.total) * 100;
			_("bsProgressBar").style.width = Math.round(percent)+"%";
			_("bsProgressBar").innerHTML = Math.round(percent)+"%";
			//$("#status").show();
			//_("status").innerHTML = Math.round(percent)+"% wrzucanie... proszę czekać";
		}
		function completeHandler(event){
			$("#status").show();
			_("status").innerHTML = event.target.responseText;
			_("bsProgressBar").innerHTML = "Ukończono";
			_("browseFile").innerHTML = '<input type="file" class="filestyle" name="upload[]" id="upload" multiple>';
			$(":file").filestyle({buttonText: "&nbsp;Wybierz nowe pliki", buttonName: "btn-primary", input: false});
			loadFiles();
		}
		function errorHandler(event){
			_("status").innerHTML = "Upload Failed";
		}
		function abortHandler(event){
			_("status").innerHTML = "Upload Aborted";
		}
		function getUrlParameter(sParam){
			var sPageURL = window.location.search.substring(1);
			var sURLVariables = sPageURL.split('&');
			for (var i = 0; i < sURLVariables.length; i++) {
				var sParameterName = sURLVariables[i].split('=');
				if (sParameterName[0] == sParam){
					return sParameterName[1];
				}
			}
		}
		function filefooter(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById("filefooter").innerHTML=xmlhttp.responseText;
					$(":file").filestyle({buttonText: "&nbsp;Wybierz pliki", buttonName: "btn-primary", input: false});
					if(_('schowek').innerHTML.length < 1)
						$("#schowek").hide();
					else 
						$("#schowek").show();
				}
			}
			xmlhttp.open("GET","php/filefooter.php?link="+getUrlParameter('link'),true);
			xmlhttp.send();
		}
		function loadFiles(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById("mainFiles").innerHTML=xmlhttp.responseText;
					
				}
			}
			xmlhttp.open("GET","php/fileList.php?link="+getUrlParameter('link'),true);
			xmlhttp.send();
		}

		function removeFile(filename){
			if (confirm('Czy na pewno chcesz usunąć?')){
				var xmlhttp;
				xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						loadFiles();
					}
				}
				xmlhttp.open("GET","php/fileRemove.php?link="+getUrlParameter('link')+"&file="+filename,true);
				xmlhttp.send();
			}else{
				return;
			}
		}
		function dirRemove(dirname){
			if (confirm('Czy na pewno chcesz usunąć?')){
				var xmlhttp;
				xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						loadFiles();
						//document.getElementById("mainFiles").innerHTML=xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","php/dirRemove.php?link="+getUrlParameter('link')+"&dir="+dirname,true);
				xmlhttp.send();
			}else{
				return;
			}
		}
		function dirCreate(){
			var xmlhttp;
			var dirname = _('dirCreateName').value;
			if(dirname ==''){
				alert('Nie podałeś nazwy');
				return;
			}
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					_("dirCreateName").value='';
					loadFiles();
				}
			}
			xmlhttp.open("GET","php/dirCreate.php?link="+getUrlParameter('link')+"&dir="+dirname,true);
			xmlhttp.send();
		}
		
		
		function setopis(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					_("setopis").value=xmlhttp.responseText;;
					loadFiles();
				}
			}
			xmlhttp.open("GET","php/setdata.php?link="+getUrlParameter('link')+"&opis="+_("setopis").value,true);
			xmlhttp.send();
		}		
		
		
		function dirpass(current_localozation){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					if(xmlhttp.responseText == 'zle'){
						alert('Hasło niepoprawne');
					}else{
						loadFiles();
					}
				}
			}
			xmlhttp.open("GET","php/dirpass.php?linkk="+current_localozation+"&haslo="+_("dirpass").value,true);
			xmlhttp.send();	
		}
		
		
		function setpassword(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					_("setpassword").value=xmlhttp.responseText;
					//alert('Hasło ustawione/usunięte');
					loadFiles();
				}
			}
			xmlhttp.open("GET","php/setdata.php?link="+getUrlParameter('link')+"&haslo="+_("setpassword").value,true);
			xmlhttp.send();
		}
		
		
		function changeName(){
			var xmlhttp;
			var oldName = _('renameOldName').value;
			var newName = _('renameNewName').value;
			if(newName ==''){
				alert('Nie podałeś nazwy');
				return;
			}
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					_('renameNewName').value='';
					$('#renameFileDir').hide();
					loadFiles();
				}
			}
			xmlhttp.open("GET","php/changeName.php?link="+getUrlParameter('link')+"&oldname="+oldName+"&newname="+newName,true);
			xmlhttp.send();
		}
		function showFileMenu(element){
			if ( $(element).children('div:last-child').is(":visible") ) {
				$(element).children('div:last-child').css('display','none');
			}
			else{
				$(element).children('div:last-child').css('display','inline-block');
			}
		}
		function schowekClear(){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					_("schowek").innerHTML='';
					_("schowek").innerHTML =_("schowek").innerHTML+xmlhttp.responseText;
					$("#schowek").hide();
					loadFiles();
				}
			}
			xmlhttp.open("GET","php/schowekSession.php?op=destroy",true);
			xmlhttp.send();
		}


		function schowekSend(newlocation){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					_("schowek").innerHTML='';
					_("schowek").innerHTML =_("schowek").innerHTML+xmlhttp.responseText;
					_("schowek").innerHTML =_("schowek").innerHTML+"Pliki skopiowane<br>";
					_("schowek").innerHTML =_("schowek").innerHTML+'<button type="submit" style="margin-left:5px;margin-top:10px;" class="btn btn-primary" onclick="$(\'#schowek\').hide();">Zamknij okno</button>';
					loadFiles();
				}
			}
			xmlhttp.open("GET","php/schowekSession.php?op=move&newlocation="+newlocation,true);
			xmlhttp.send();
		}

		function zipCreate(newlocation){
			var xmlhttp;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					_("schowek").innerHTML='';
					_("schowek").innerHTML =_("schowek").innerHTML+xmlhttp.responseText;
					_("schowek").innerHTML =_("schowek").innerHTML+"Pliki spakowane<br>";
					_("schowek").innerHTML =_("schowek").innerHTML+'<button type="submit" style="margin-left:5px;margin-top:10px;" class="btn btn-primary" onclick="$(\'#schowek\').hide();">Zamknij okno</button>';
					loadFiles();
				}
			}
			xmlhttp.open("GET","php/schowekSession.php?op=zipcreate&newlocation="+newlocation,true);
			xmlhttp.send();
		}
	</script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container" style="width:80%;">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Haks.pl file browser</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				logowanie
			</div><!--/.navbar-collapse -->
		</div>
	</nav>
	<div class="container" style="width:100%; display:inline-block; margin-top:10px;">
		<div class="list-group" style="width:25%; display:inline-block; float:left; margin-right:1%;">
			<div class="list-group-item list-group-item-info">Linki</div>
			<div class="list-group-item"><a href="http://wp.haks.pl">WordPress</a></div>
			<div class="list-group-item"><a href="http://proxy.haks.pl">Proxy</a></div>
			<div id="registerid">

			</div>
			<div class="list-group-item list-group-item-warning">Informacje</div>
			<div class="list-group-item">Pobranie pliku dwukrotne kliknięcie na ikonę lub jednokrotne na opis.</div>
			<div class="list-group-item">Zmiany na pliku jednokrotne kliknięcie na ikonę.</div>
			<div class="list-group-item">Upload wielu plików na raz.</div>
			<div class="list-group-item">Katalogi z możliwością dostępu na hasło.</div>
		</div>

		<div class="panel panel-primary" style="width:74%; float:left;  display:inline-block;">
			<div class="panel-heading">
				<span id="goToTop" style="cursor:pointer; float:left; display:none;" class="glyphicon glyphicon-arrow-up" aria-hidden="true">&nbsp;</span>
				Pliki: <strong><?php genCurrentLink(); ?></strong>
				<span id="goToTop2" style="cursor:pointer; float:right; display:none;" class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
				
			</div>
			<div class="panel-body" id="mainFiles" style="margin-bottom:10px;">
				files
			</div>
			<div class="panel-footer" id="filefooter">
				files footer
			</div>
		</div>
	</div>
	<div id="renameFileDir" class="well">
		<div class="form-group">
			<fieldset disabled>
				<label for="renameOldName">Stara nazwa</label>
				<input type="text" class="form-control" id="renameOldName" placeholder="stara nazwa">
			</fieldset>
		</div>
		<div class="form-group">
			<label for="renameNewName">Nowa nazwa</label>
			<input type="text" class="form-control" id="renameNewName" placeholder="nowa nazwa">
		</div>
		<button type="submit" class="btn btn-default" onclick="$('#renameFileDir').hide();">Anuluj</button>
		<button type="submit" class="btn btn-primary" onclick="changeName();">Zmień</button>
	</div>

	<blockquote class="blockquote-reverse" style="border-color: #680000 ; ">
		<p>Copyright haks.pl &copy; 2015. Created by Paweł Czubak.</p>
		<footer>haks.pl <cite title="Source Title">file browser</cite></footer>
	</blockquote>
	<script>log_check();reg_check();filefooter();</script>
	<?php goToTop(); ?>
</body>
</html>