//Create HTTPRequest object and return it
function GetXmlHttpObject()
{
    var xmlHttp=null;
    if (window.XMLHttpRequest) {
		xmlHttp = new window.XMLHttpRequest;
	}
	else {
		try {
			xmlHttp =  new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(ex) {
			xmlHttp = null;
		}
	}
	return xmlHttp;
}



//Trim taken from http://blog.stevenlevithan.com/archives/faster-trim-javascript
function trim12(stri) {
	var	str = stri.replace(/^\s\s*/, ''),
		ws = /\s/,
		i = stri.length;
	while (ws.test(str.charAt(--i)));
	return str.slice(0, i + 1);
}



function loadentries(){
    var xmlHttpSK = GetXmlHttpObject();
    var url = "load.php";
    //Clear the content page
    document.getElementById("entries").innerHTML = "Loading your journal entries...";

    if(xmlHttpSK != null){
    	xmlHttpSK.onreadystatechange=function(){
    		if (xmlHttpSK.readyState == 4)
    		{ 
    			if(xmlHttpSK.status == 200){
    				res = xmlHttpSK.responseText;
    				if(res!=null){
                        document.getElementById("entries").innerHTML = res;
                        document.getElementById("journalnotes").value="";
                        document.getElementById("journalnotes").focus();
    				} else {
    					alert("Error while retrieving data. Please try again.");
    					document.getElementById("entries").innerHTML="&nbsp";
    				}
    			} else if (xmlHttpSK.status == 404){
    				alert("Request URL does not exist");
    				document.getElementById("entries").innerHTML="&nbsp";
    			} else {
    				alert("Error: status code is (2):" + xmlHttpSK.status);	
    				document.getElementById("entries").innerHTML="&nbsp";
    			}
    		}
    	};
    	xmlHttpSK.open("GET",url,true);
    	xmlHttpSK.send(null);
        return true;
    } else {
    	alert('Your browser doesn\'t support AJAX');
    	return;		
    }
}



function authenticate(){
    var xmlHttpSK = GetXmlHttpObject();
    var url = "auth.php";
    var uname = document.getElementById("username").value;
    var pass = document.getElementById("password").value;
    

    //Evaluate the values
    if(trim12(uname)===''){
    	document.getElementById("notifications").innerHTML ="<span style=\"color:darkred\">Please enter username</span>";
    	document.getElementById("username").focus();
    	return false;    	
    }
    
    if(trim12(pass)===''){
    	document.getElementById("notifications").innerHTML = "<span style=\"color:darkred\">Please enter password</span>";
    	document.getElementById("password").focus();
    	return false;
    }
    //Clear the content page
    document.getElementById("notifications").innerHTML = "Logging in...";
    url += "?username="+uname+"&password="+pass;

    if(xmlHttpSK != null){
    	xmlHttpSK.onreadystatechange=function(){
    		if (xmlHttpSK.readyState == 4)
    		{ 
    			if (xmlHttpSK.status == 200){
    				res = xmlHttpSK.responseText;
    				if (res!=null){
                        if (res === 'failed') {
                           document.getElementById("notifications").innerHTML = "<span style=\"color:darkred\">Invalid Credentials. Please check entered details.</span>";
                        } else {
                            location.reload();
                        }
    				} else {
    					alert("Error while retrieving data. Please try again.");
    					document.getElementById("notifications").innerHTML="&nbsp";
    				}
    			} else if (xmlHttpSK.status == 404){
    				alert("Request URL does not exist");
    				document.getElementById("notifications").innerHTML="&nbsp";
    			} else {
    				alert("Error: status code is (2):" + xmlHttpSK.status);	
    				document.getElementById("notifications").innerHTML="&nbsp";
    			}
    		}
    	};
    	xmlHttpSK.open("GET",url,true);
    	xmlHttpSK.send(null);
        return true;
    } else {
    	alert('Your browser doesn\'t support AJAX');
    	return;		
    }
}


function addentry(){
    var xmlHttpSK = GetXmlHttpObject();
    var url = "add.php";
    var notes = document.getElementById("journalnotes").value;
    

    //Evaluate the values
    if(trim12(notes)===''){
    	document.getElementById("notifications").innerHTML = "Please add some notes";
    	document.getElementById("journalnotes").focus();
    	return false;    	
    }
    

    //Post the data
    if(xmlHttpSK != null){
    	xmlHttpSK.onreadystatechange=function(){
    		if (xmlHttpSK.readyState == 4)
    		{ 
    			if(xmlHttpSK.status == 200){
    				res = xmlHttpSK.responseText;
    				if(res!=null){
                        if (res === 'failed') {
                           document.getElementById("notifications").innerHTML = "Apologies. Failed to add entry. Please try again";
                        } else {
                            var article = document.createElement('article');
                            article.innerHTML = res;
                            var diven = document.getElementById('entries');
                            diven.insertBefore(article,diven.firstChild);
                            document.getElementById("journalnotes").value="";
                            document.getElementById("journalnotes").focus();
                        }
    				} else {
    					alert("Error while sending data. Please try again.");
    				}
    			} else if (xmlHttpSK.status == 404){
    				alert("Request URL does not exist");
    			} else {
    				alert("Error: status code is (2):" + xmlHttpSK.status);	
    			}
    		}
    	};
    	xmlHttpSK.open("POST",url,true);
    	xmlHttpSK.setRequestHeader("Content-type","application/x-www-form-urlencoded;charset=UTF-8");
    	xmlHttpSK.send("notes="+encodeURIComponent(notes));
        return true;
    } else {
    	alert('Your browser doesn\'t support AJAX');
    	return;		
    }
}

function updateentry(id,entry){
    var xmlHttpSK = GetXmlHttpObject();
    var url = "upd.php";
    

    //Evaluate the values
    if(trim12(id)===''){
    	document.getElementById("notifications").innerHTML = "id cant be empty";
    	return false;    	
    }
    
    if(trim12(entry)===''){
    	document.getElementById("notifications").innerHTML = "Cant post empty entry";
    	document.getElementById("updated_by").focus();
    	return false;
    }

    //Post the data
    if(xmlHttpSK != null){
    	xmlHttpSK.onreadystatechange=function(){
    		if (xmlHttpSK.readyState == 4)
    		{ 
    			if(xmlHttpSK.status == 200){
    				res = xmlHttpSK.responseText;
    				if(res!=null){
                        document.getElementById("notifications").innerHTML = res;
    				} else {
    					alert("Error while sending data. Please try again.");
    				}
    			} else if (xmlHttpSK.status == 404){
    				alert("Request URL does not exist");
    			} else {
    				alert("Error: status code is (2):" + xmlHttpSK.status);	
    			}
    		}
    	};
    	xmlHttpSK.open("POST",url,true);
    	xmlHttpSK.setRequestHeader("Content-type","application/x-www-form-urlencoded;charset=UTF-8");
    	xmlHttpSK.send("jid="+encodeURIComponent(id)+" &jentry="+encodeURIComponent(entry));
        return true;
    } else {
    	alert('Your browser doesn\'t support AJAX');
    	return;		
    }
}

function registeruser(){
    var xmlHttpSK = GetXmlHttpObject();
    var url = "reg.php";
    username = document.getElementById("username").value;
    password = document.getElementById("password").value;
    email = document.getElementById("email").value;
    

    //Evaluate the values
    if(trim12(username)===''){
    	document.getElementById("notifications").innerHTML = "Please enter user name";
        document.getElementById("username").focus();
    	return false;    	
    }
    
    if(trim12(password)===''){
    	document.getElementById("notifications").innerHTML = "Please enter password";
    	document.getElementById("password").focus();
    	return false;
    }

    if(trim12(email)===''){
    	document.getElementById("notifications").innerHTML = "Please enter your email id";
    	document.getElementById("email").focus();
    	return false;
    }

    //Post the data
    if(xmlHttpSK != null){
    	xmlHttpSK.onreadystatechange=function(){
    		if (xmlHttpSK.readyState == 4)
    		{ 
    			if(xmlHttpSK.status == 200){
    				res = xmlHttpSK.responseText;
    				if(res!=null){
                        document.getElementById("notifications").innerHTML = res;
    				} else {
    					alert("Error while sending data. Please try again.");
    				}
    			} else if (xmlHttpSK.status == 404){
    				alert("Request URL does not exist");
    			} else {
    				alert("Error: status code is (2):" + xmlHttpSK.status);	
    			}
    		}
    	};
    	xmlHttpSK.open("POST",url,true);
    	xmlHttpSK.setRequestHeader("Content-type","application/x-www-form-urlencoded;charset=UTF-8");
    	xmlHttpSK.send("username="+encodeURIComponent(username)+" &password="+encodeURIComponent(password)+"&email="+encodeURIComponent(email));
        return true;
    } else {
    	alert('Your browser doesn\'t support AJAX');
    	return;		
    }
}
