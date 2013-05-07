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
    var url = "entries.php?request=load";
    //Clear the content page
    document.getElementById("content").innerHTML = "Loading lrgs...";

    if(xmlHttpSK != null){
    	xmlHttpSK.onreadystatechange=function(){
    		if (xmlHttpSK.readyState == 4)
    		{ 
    			if(xmlHttpSK.status == 200){
    				res = xmlHttpSK.responseText;
    				if(res!=null){
                        document.getElementById("content").innerHTML = res;
                        initializeDataTable();
    				} else {
    					alert("Error while retrieving data. Please try again.");
    					document.getElementById("content").innerHTML="&nbsp";
    				}
    			} else if (xmlHttpSK.status == 404){
    				alert("Request URL does not exist");
    				document.getElementById("content").innerHTML="&nbsp";
    			} else {
    				alert("Error: status code is (2):" + xmlHttpSK.status);	
    				document.getElementById("content").innerHTML="&nbsp";
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
    			if(xmlHttpSK.status == 200){
    				res = xmlHttpSK.responseText;
    				if(res!=null){
                        window.location="'"+res+"'";
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
    var url = "/lrgconversion/StatusGetter";
    var lrgs = document.getElementById("lrglist").value;
    var postby = document.getElementById("updated_by").value;
    

    //Evaluate the values
    if(trim12(lrgs)===''){
    	document.getElementById("notifications").innerHTML = "Please add list of lrgs";
    	document.getElementById("lrglist").focus();
    	return false;    	
    }
    
    if(trim12(postby)===''){
    	document.getElementById("notifications").innerHTML = "Please enter your GUID";
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
    	xmlHttpSK.setRequestHeader("Content-length", lrgs.length+postby.length);
    	xmlHttpSK.send("lrglist="+encodeURIComponent(lrgs)+" &updated_by="+encodeURIComponent(postby));
        return true;
    } else {
    	alert('Your browser doesn\'t support AJAX');
    	return;		
    }
}
