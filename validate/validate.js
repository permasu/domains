/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var xmlHttp = createXmlHttpRequestObject();

var serverAddress = "validate.php";
var updateInterval = 5;  //время ожидания перед запросом нового сообщения
var showErros = true;
var debugMode = true;   //если установлено true то выводятся подробные сообещния об ошибках
car
cache = new Array();

function createXmlHttpRequestObject() {
    var xmlHttp;
    try {
        xmlHttp = new XMLHttpRequest();
    }
    catch (e) {
        var XMLHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
            "MSXML2.XMLHTTP.5.0",
            "MSXML2.XMLHTTP.4.0",
            "MSXML2.XMLHTTP.3.0",
            "MSXML2.XMLHTTP.2.0",
            "Microsoft.XMLHTTP");
        for (var i = 0; i < XMLHttpVersions.length && !xmlHttp; i++) {
            try {
                xmlHttp = new ActiveXObject(XMLHttpVersions[i]);
            }
            catch (e) {
            }
        }
    }
    if (!xmlHttp)
        alert("Ошибка создания xmlHttpRequest.");
    else
        return xmlHttp;


}

function process() {
    if (xmlHttp) {
        try {
            display("Чтение нового сообщения с сервера...");
            xmlHttp.open("GET", serverAddress, true);
            xmlHttp.onreadystatechange = handleGettingNews;
            xmlHttp.send(null);
        }
        catch (e) {
            alert("Невозможно соединиться с сервером\n" + e.toString());
        }
    }
}


function displayError($message) {
    if (showErros) {
        //если установлено true то выводятся подробные сообещния об ошибках
        showErros = false;
        alert("Обнаружена ошибка: \n" + $message);
        setTimeout("validate();", 10000);
    }
}

function validate(inputValue, fieldID) {
    if (!xmlHttp) {
    } else {
        if (fieldID) {
            inputValue = encodeURIComponent(inputValue);
            fieldID = encodeURIComponent(fieldID);
            cache.push("Input value=" + inputValue + "%fieldID=" + fieldID)
        }
        try {
            if ((xmlHttp.readyState == 4 || xmlHttp.readyState == 0) &&
                cache.length > 0)
            {
                //извлечь новый набор из параметров запроса
                var CacheEntry  =   cache.shift();
                xmlHttp.open("POST", serverAddress, true);
                xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlHttp.onreadystatechange  =   handleRequestStateChange;
                xmlHttp.send(CacheEntry);

            }
        }
        catch(e)
        {displayError(e.toString());}

    }
}
function handleRequestStateChange()
{
    if (xmlHttp.readyState    ==  4)
    {
        if (xmlHttp.status    ==  200)
        {
            try
            {
                readResponse();
            }
            catch(e)
            {
                displayError(e.toString());
            }
        }
        else
        {
            displayError(xmlHttp.statusText);
        }
    }

}
function readResponse() {
    var response    =   xmlHttp.responseText;
    if (response.indexOf("ERRNO"))>=0
    || (response.indexOf("error:"))>=0
    || (response.length==0)
    throw (response.length==0 ? "Server error." : response);

    var responseXML = xmlHttp.responseXML;
    var root_node = responseXML.getElementsByTagName('response').item(0);
    document.getElementById('divMessage').innerHTML = root_node.firstChild.data;

}