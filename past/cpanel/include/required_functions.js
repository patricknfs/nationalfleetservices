function changeScrollbarColor() {
document.body.style.scrollbarBaseColor = '#636562';
document.body.style.scrollbarFaceColor='#FFFFFF';
document.body.style.scrollbarArrowColor='#6E89DD';
document.body.style.scrollbarTrackColor='#FFFFFF';
document.body.style.scrollbarShadowColor='#FFFFFF';
document.body.style.scrollbarHighlightColor='#EEECEF';
document.body.style.scrollbar3dlightColor='#EEECEF';
document.body.style.scrollbarDarkshadowColor='#000000';
}

function trim(str){
return str.replace(/^\s+|\s+$/g,'');
}


function PreloadImages(){
   imgUp = new Image();
   imgUp.src = 'images/UP.gif';
   imgDown = new Image();
   imgDown.src = 'images/DOWN.gif'; 
}

function toggleMenu(getMenu,getenuImage){

	PreloadImages();
	
    getMenu.style.display = (getMenu.style.display=="none") ? "" : "none";
    if (getMenu.style.display == "none") {
    	getenuImage.src=imgDown.src;
    }
    else {
    	getenuImage.src=imgUp.src;
    }
}

function selectAll(theField) {
var tempval=eval("document."+theField)
tempval.focus()
tempval.select()
}

if (document.layers) {n=1;ie=0}
if (document.all) {n=0;ie=1}
if (!document.all && !document.layers) {n=0;ie=1;}
function init() {
        if (n) tab = document.tabDiv
		if (n) poptext = document.poptextDiv
		if (ie) tab = tabDiv.style
        if (ie) poptext = poptextDiv.style
}

var tabShow=0;

//Hide-Show Layer
function hideMenus() {
        if (tabShow == 1) {
        	if (n) {
                tab.visibility = "hide";
                tab.left = 0;
                tab.visibility = "show";
                poptext.visibility = "hide";
                tabShow = 0;
				document.all.myLeftTD.width='10px;';
				document.all.myPanelmage.src='images/nav.jpg';
                return;
           	}
			if (ie) {
                tab.visibility = "hidden";
                tab.left = 0;
                tab.visibility = "visible";
                poptext.visibility = "hidden";
                tabShow = 0;
				document.all.myLeftTD.width='10px;';
				document.all.myPanelmage.src='images/nav.jpg';
                return;
           }
  }
                
        if (tabShow == 0) {
        	if (n) {
                tab.visibility = "hide";
                tab.left = 200;
                tab.visibility = "show";
                poptext.visibility = "show";
                tabShow = 1;
				document.all.myLeftTD.width='188px;';
				document.all.myPanelmage.src='images/nav2.jpg';
       			   }
			if (ie) {
				tab.visibility = "hidden";
                tab.left = 200;
                tab.visibility = "visible";
                poptext.visibility = "visible";
                tabShow = 1;
				document.all.myLeftTD.width='188px;';
				document.all.myPanelmage.src='images/nav2.jpg';
				}
}
}

function isDate(dateStr) {
var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
var matchArray = dateStr.match(datePat); // is the format ok?
if (matchArray == null) {
alert("Please Enter date as mm/dd/yyyy.");
return false;
}
month = matchArray[1]; // p@rse date into variables
day = matchArray[3];
year = matchArray[5];
if (month < 1 || month > 12) { // check month range
alert("Month must be between 1 and 12.");
return false;
}
if (day < 1 || day > 31) {
alert("Day must be between 1 and 31.");
return false;
}
if ((month==4 || month==6 || month==9 || month==11) && day==31) {
alert("Month "+month+" doesn`t have 31 days!")
return false;
}
if (month == 2) { // check for february 29th
var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
if (day > 29 || (day==29 && !isleap)) {
alert("February " + year + " doesn`t have " + day + " days!");
return false;
}
}
return true; // date is valid
}

function isNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;
}

function isSpecialChars(str){
specialchars=".,|!@#$%^&*()~`'?;: ";
for (var i = 0; i < str.length; i++) {
if (specialchars.indexOf(str.charAt(i)) != -1) {
return false;
}
}
}


function isTelephone(str){
var validNum="0123456789-";
var isValid=true;
var char;

for (var i=0;i<str.length && isValid==true;i++){
char=str.charAt(i);
if(validNum.indexOf(char)==-1){
isValid=false;
}
}
return isValid;
}

function isEmail(str){
var at="@";
var dot=".";
var lat=str.indexOf(at);
var ldot=str.indexOf(dot);
var lstr=str.length;

if(str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
return false;
}
if(str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
return false;
}
if(str.indexOf(" ")!=-1){
return false;
}
if(str.indexOf(at,(lat+1))!=-1){
return false;
}
if(str.indexOf(dot,(lat+2))==-1){
return false;
}
if(str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
return false;
}
return true;
}

function Left(str, n){
	if (n <= 0)
	    return "";
	else if (n > String(str).length)
	    return str;
	else
	    return String(str).substring(0,n);
}
function Right(str, n){
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
}