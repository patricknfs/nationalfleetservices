<!--
	function moveSelect(sourceID, destID){
		var sourceid = document.getElementById(sourceID);
		var destid = document.getElementById(destID);
		var sourceidlen = sourceid.options.length;
		var destidlen = destid.options.length;
		var sourceArray = new Array();
		var destArray = new Array();
		var found = false;
		var cnt1 = 0;
		var cnt2 = 0;
		for(i=0; i<sourceidlen;i++){
			if(sourceid.options[i].selected){
				for(j=0; j<destidlen;j++){
					if(sourceid.options[i].value==destid.options[j].value){
						found = true;
						alert("Error '"+sourceid.options[i].value+"' already exists in other listbox!");
					}
				}
				if(found==false){
					destArray[cnt1] = new Array(sourceid.options[i].text, sourceid.options[i].value);
					cnt1++;
				}
			}else{
				sourceArray[cnt2] = new Array(sourceid.options[i].text, sourceid.options[i].value);
				cnt2++;
			}
		}
		sourceArray.sort();
		removeAllItems(sourceID);
		for(i=0; i < sourceArray.length; i++){
			sourceid.options[i] = new Option(sourceArray[i][0], sourceArray[i][1]);
		}
		
		for(i=0; i < destidlen; i++){
			destArray[cnt1] = new Array(destid.options[i].text, destid.options[i].value);
			cnt1++;
		}
		destArray.sort();
		removeAllItems(destID);
		for(i=0; i < destArray.length; i++){
			destid.options[i] = new Option(destArray[i][0], destArray[i][1]);
		}
	}
	
	function removeAllItems(srID){
		var tmpID = document.getElementById(srID);
		 for(i=tmpID.length-1; i>=0; i--){
		 	 tmpID.options[i] = null;
		 }
	}
	
	function funSetSelValues(listBoxID, hTxtID){
		var listBoxID = document.getElementById(listBoxID);
		var hTxtID = document.getElementById(hTxtID);
		var listBoxIDlen = listBoxID.options.length;
		var tmpVals = "";
		for(i=0; i<listBoxIDlen;i++){
			tmpVals = tmpVals + listBoxID.options[i].value + ",";
		}
		hTxtID.value = "";
		hTxtID.value = tmpVals;
	}
	
// -->