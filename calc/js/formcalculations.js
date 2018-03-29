// Product
var product_price= new Array();
product_price["business"]="b";
product_price["personal"]="p";

function getProductPrice()
{
	var qProductPrice=0;
	var theForm = document.forms["cakeform"];
	var selectedProduct = theForm.elements["product"];
	
	qProductPrice = product_price[selectedProduct.value];
	return qProductPrice;
}


// Term
var term_price= new Array();
term_price["24"]="2";
term_price["36"]="3";
term_price["48"]="4";

function getTermPrice()
{
	var qTermPrice=0;
	var theForm = document.forms["cakeform"];
	var selectedTerm = theForm.elements["term"];
	
	qTermPrice = term_price[selectedTerm.value];
	return qTermPrice;
}


// Kpa
var kpa_price= new Array();
kpa_price["10"]="10";
kpa_price["15"]="15";
kpa_price["20"]="20";

function getKpaPrice()
{
	var qKpaPrice=0;
	var theForm = document.forms["cakeform"];
	var selectedKpa = theForm.elements["kpa"];
	
	qKpaPrice = kpa_price[selectedKpa.value];
	return qKpaPrice;
}


// Maint
var maint_price= new Array();
maint_price["yes"]="1";
maint_price["no"]="0";

function getMaintPrice()
{
	var qMaintPrice=0;
	var theForm = document.forms["cakeform"];
	var selectedMaint = theForm.elements["maint"];
     
	qMaintPrice = maint_price[selectedMaint.value];
	return qMaintPrice;
}


function calculateTotal()
{
    var cakePrice = getProductPrice() + getTermPrice() + getKpaPrice() + getMaintPrice();
    
    var divobj = document.getElementById('totalPrice');
    divobj.style.display='block';
    divobj.innerHTML = cakePrice;
	
matrix = {
  'b2100': 210.50,
  'b2150': 215.50,
  'b2200': 220.50,
  'b2101': 210.95,
  'b2151': 215.95,
  'b2201': 220.95,
  
  'p2100': 210.51,
  'p2150': 215.51,
  'p2200': 220.51,
  'p2101': 210.96,
  'p2151': 215.96,
  'p2201': 220.96,
};

matrix[cakePrice];

    var divobj = document.getElementById('pulledPrice');
    divobj.style.display='block';
	divobj.innerHTML = (matrix[cakePrice]);
	
}