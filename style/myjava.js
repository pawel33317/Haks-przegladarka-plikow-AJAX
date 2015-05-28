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
schowekCheck();


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
schowekCheck();

















