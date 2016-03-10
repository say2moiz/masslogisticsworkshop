/*This is the custom datasource file that has all that is required to setup the datasources
for xmlhttp retrieves.*/
var dataSource =
{
    "updatepurchase": "updatepurchase.php?",
    "getpartsforthisbrand":"getpartsforthisbrand.php?",
    "getpart":"getpart.php?",
    "addbrand":"addbrand.php?",
    "addpart":"addpart.php?",
    "addseller":"addseller.php?",
    "addbuyer":"addbuyer.php?",
    "addissuer":"addissuer.php?",
    "addscrapreceiver":"addscrapreceiver.php?",
    "getpartdetails":"getpartdetails.php?",
    "getbranddetails":"getbranddetails.php?",
    "adduser":"adduser.php?",
    "getuserdetails":"getuserdetails.php?",
    "getpartsinstockforthisbrand":"getpartsinstockforthisbrand.php?",
    "checkmaxavailablestock":"checkmaxavailablestock.php?",
    "checktrackingidexpiry":"checktrackingidexpiry.php?",
    "checktrackingid":"checktrackingid.php?",
    "updatetrackingid":"updatetrackingid.php?",
    "addvehical":"addvehical.php?",
    "addrackinstore":"addrackinstore.php?",
    "login":"login.php?",
    "changeusername":"changeusername.php?",
    "changesecurityplan":"changesecurityplan.php?"
}

function getHttpFeedURL( datasource ) {
	if(dataSource[datasource]!=''){
	    var qry = JsonBase() + dataSource[datasource];}
	else    { var qry = dataSource[datasource];}
    return qry;
}
function setHttpParameter( url, parmname, value ) {
    return url + parmname + '=' + value + '&';
}
function initializeHttpRequest ( feedURL, onSuccessHandler, onErrorHandler ) {
    var onloadHandler = function( ) {
        if ( xmlRequest.readyState==4 && xmlRequest.status == 200 ) {
            onSuccessHandler( xmlRequest.responseText );
        }
      
     };
    var xmlRequest = new XMLHttpRequest();
	xmlRequest.onreadystatechange=onloadHandler;
    //xmlRequest.onload = onloadHandler;
    xmlRequest.open("GET", feedURL );
    xmlRequest.setRequestHeader("Cache-Control", "no-cache");
    xmlRequest.send(null);
}
// Called when an XMLHttpRequest loads a feed; works with the XMLHttpRequest setup snippet
function xmlLoaded(xmlRequest) 
{
    if (xmlRequest.readyState==4 && xmlRequest.status == 200) {
        alert( 'Request Received');
    }
    else {
	alert("Error fetching data: HTTP status " + xmlRequest.status);
    }
}

