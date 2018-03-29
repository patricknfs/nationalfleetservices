// JavaScript Document
// Declaring required variables
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
s=stripCharsInBag(strPhone,validWorldPhoneChars);
return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}

function isValidEmail(Email)
{
	var pattern = /^([a-zA-Z0-9_\-])+(\.([a-zA-Z0-9_\-])+)*@((\[(((([0-1])?([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5])))\.(((([0-1])?([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5])))\.(((([0-1])?([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5])))\.(((([0-1])?([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5]))\]))|((([a-zA-Z0-9])+(([\-])+([a-zA-Z0-9])+)*\.)+([a-zA-Z])+(([\-])+([a-zA-Z0-9])+)*))$/;
	return  pattern.test(Email);
	
}

function validateCallme(){
	var frm1 = document.quick_contact;
	
	if(frm1.fullname.value == 'Full Name'){
		alert('Error! Please enter name');
		frm1.fullname.focus();
		return false;
	}
	if(frm1.phone.value == 'Contact Number'){
		alert('Error! Please phone number');
		frm1.phone.focus();
		return false;
	}
	if(checkInternationalPhone(frm1.phone.value) == false){
		alert("Error: Please fill up your correct phone number!");
		frm1.phone.focus();
		return false;
	}
return true;	
}

//----------------FUNCTION TO VALIDATE CONTACT US-------------------------//

function funValidateContForm()
{
	var frm = document.contact;
	if(frm.cname.value == '')
	 {
	 	alert("Please enter your name");
		frm.cname.focus();
		return false;
	 }
	 if(frm.cemail.value == '')
	 {
	 	alert("Please enter your email");
		frm.cemail.focus();
		return false;
	 }
	if(isValidEmail(frm.cemail.value) == false)
	 {
	 	alert("Please enter your valid email");
		frm.cemail.focus();
		return false;
	 }
	if(frm.phone.value == '')
	 {
	 	alert("Please enter your phone number");
		frm.phone.focus();
		return false;
	 }
	if(checkInternationalPhone(frm.phone.value) == false)
	 {
	 	alert("Please enter your valid phone number");
		frm.phone.focus();
		return false;
	 }
	if(frm.fax.value != '')
	 {
		if(checkInternationalPhone(frm.fax.value) == false)
		 {
			alert("Please enter your valid fax number");
			frm.fax.focus();
			return false;
		 }
	 }
	if(frm.comments.value == '')
	 {
	 	alert("Please enter your comments");
		frm.comments.focus();
		return false;
	 }
 return true;	 
}
//---------------------VALIDATE QUOTATION FORM-----------------------------------//
function qutValidateForm()
 {
 	var frm = document.quotation;
	if(frm.make_id.value == '')
	 {
	 	alert("Please choose make");
		frm.make_id.focus();
		return false;
	 }
	if(frm.period.value == '')
	 {
	 	alert("Please choose contract period");
		frm.period.focus();
		return false;
	 }
	if(frm.model_id.value == '')
	 {
	 	alert("Please choose model");
		frm.model_id.focus();
		return false;
	 } 
	if(frm.contype.value == '')
	 {
	 	alert("Please choose your contract type");
		frm.contype.focus();
		return false;
	 }
 	if(frm.firstname.value == '')
	 {
	 	alert("Please enter your first name");
		frm.firstname.focus();
		return false;
	 }
	if(frm.email.value == '')
	 {
	 	alert("Please enter your email");
		frm.email.focus();
		return false;
	 }
	 if(isValidEmail(frm.email.value) == false)
	 {
	 	alert("Please enter your valid email");
		frm.email.focus();
		return false;
	 }
	if(frm.phone.value == '')
	 {
	 	alert("Please enter your phone number");
		frm.phone.focus();
		return false;
	 }
	if(checkInternationalPhone(frm.phone.value) == false)
	 {
	 	alert("Please enter your valid phone number");
		frm.phone.focus();
		return false;
	 } 
	if(frm.extrainfo.value == '')
	 {
	 	alert("Please enter your queries");
		frm.extrainfo.focus();
		return false;
	 }
 }
