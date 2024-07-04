
function checkAll(field)
{
	
	//alert('yes:line12');
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}




function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}
//sms count
maxL=160;
maxL2=67;
var bName = navigator.appName;
function taLimit(taObj) {
	if (taObj.value.length==maxL) return false;
	return true;
}
function taLimit2(taObj) {
	if (taObj.value.length==maxL2) return false;
	return true;
}

function taCount(taObj,Cnt) { 
	objCnt=createObject(Cnt);
	objVal=taObj.value;
	if (objVal.length>maxL) objVal=objVal.substring(0,maxL);
	if (objCnt) {
		if(bName == "Netscape"){	
			objCnt.textContent=maxL-objVal.length;}
		else{objCnt.innerText=maxL-objVal.length;}
	}
	return true;
}
function taCount2(taObj,Cnt) { 
	objCnt=createObject(Cnt);
	objVal=taObj.value;
	if (objVal.length>maxL2) objVal=objVal.substring(0,maxL2);
	if (objCnt) {
		if(bName == "Netscape"){	
			objCnt.textContent=maxL2-objVal.length;}
		else{objCnt.innerText=maxL2-objVal.length;}
	}
	return true;
}



function createObject(objId) {
	if (document.getElementById) return document.getElementById(objId);
	else if (document.layers) return eval("document." + objId);
	else if (document.all) return eval("document.all." + objId);
	else return eval("document." + objId);
}