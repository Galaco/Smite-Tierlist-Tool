var masterItemList = [];

function Item(){
	this.id = 0
	this.name = ""
	this.description = ""
	this.price = 0
	this.tier = 0
	this.iconURL = ""
	this.type = ""
	this.starter = 0
};

function addItem(name, description, price, tier, iconURL, type, id, starter)
{
	var item = new Item();
	item.id = id;
	item.name = name;
	item.description = description;
	item.price = price;
	item.tier = tier;
	item.iconURL = iconURL;
	item.type = type;
	item.starter = starter
	
	masterItemList.push(item);
}


function updateList(){
	var tier0 = false;
	if($('#category_tier0').is(":checked")) tier0 = true;
	var tier1 = false;
	if($('#category_tier1').is(":checked")) tier1 = true;
	var tier2 = false;
	if($('#category_tier2').is(":checked")) tier2 = true;
	var tier3 = false;
	if($('#category_tier3').is(":checked")) tier3 = true;
	var allowItem = false;
	if($('#category_item').is(":checked")) allowItem = true;
	var allowActive = false;
	if($('#category_active').is(":checked")) allowActive = true;
	var allowConsumable = false;
	if($('#category_consumable').is(":checked")) allowConsumable = true;
	
	$('#item_main').empty();
	
	
	masterItemList.forEach( function(item) {
		if (!tier0 && item.starter) return;
		if (!tier1 && item.tier == 1 && item.starter != 1 &&  item.type == "Item") return;
		if (!tier2 && item.tier == 2) return;
		if (!tier3 && item.tier == 3) return;
		if (!allowItem && item.type == "Item") return;
		if (!allowActive && item.type == "Active") return;
		if (!allowConsumable && item.type == "Consumable") return;

		var entry = document.createElement('a'),
		$entry = $(entry);
		$entry.attr('href', '/items/item/'+item.id);
		$entry.addClass('item_row');
		$entry.append('<span class="icon"><img src="'+ item.iconURL +'"/></span>');
		$entry.append('<span class="name">'+ item.name +'</span>');
		$entry.append('<span class="description">'+ item.description +'</span>');
		$entry.append('<span class="price">'+ item.price +'</span>');
		
		$("#item_main").append(entry);
	})
}

$(document).ready(function(){
	$('#category_tier0').change(function() {
        updateList();      
    });
	$('#category_tier1').change(function() {
        updateList();      
    });
	$('#category_tier2').change(function() {
        updateList();      
    });
	$('#category_tier3').change(function() {
        updateList();      
    });
	$('#category_item').change(function() {
        updateList();      
    });
	$('#category_active').change(function() {
        updateList();      
    });
	$('#category_consumable').change(function() {
        updateList();      
    });
	
	masterItemList.sort(function(a,b) {
		if (a.name < b.name) return -1; 
		if (a.name > b.name) return 1;
		return 0;
	});
	updateList();
});