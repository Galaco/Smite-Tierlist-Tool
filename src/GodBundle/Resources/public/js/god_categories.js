var godDomList = [];
var guardianDomList = [];
var warriorDomList = [];
var assassinDomList = [];
var mageDomList = [];
var hunterDomList = [];

var categoryList = [];

function addGodToList(id, type)
{
	godDomList.push($("#"+id));
	if (type == " Guardian")
	{
		guardianDomList.push($("#"+id));
		return;
	}
	if (type == " Warrior")
	{
		warriorDomList.push($("#"+id));
		return;
	}
	if (type == " Assassin")
	{
		assassinDomList.push($("#"+id));
		return;
	}
	if (type == " Mage")
	{
		mageDomList.push($("#"+id));
		return;
	}
	if (type == " Hunter")
	{
		hunterDomList.push($("#"+id));
		return;
	}
}

function setVisibleElements(godIndex) {
	console.log("test")
	if (godIndex == 0) {
		var index, len;
		for (index = 0, len = godDomList.length; index < len; ++index) {
			godDomList[index].css("display", "inline-block");
		}
	} else {
		var index, len;
		for (index = 0, len = godDomList.length; index < len; ++index) {
			godDomList[index].css("display", "none");
		}
			
		for (index = 0, len = categoryList[godIndex].length; index < len; ++index) {
			categoryList[godIndex][index].css("display", "inline-block");
		}
	}
}

domReady(function(){
	categoryList.push(godDomList);
	categoryList.push(guardianDomList);
	categoryList.push(warriorDomList);
	categoryList.push(assassinDomList);
	categoryList.push(mageDomList);
	categoryList.push(hunterDomList);
	
	hookCustomNavbar(setVisibleElements, '#tab_nav_');
	hookPageNavbar();
});