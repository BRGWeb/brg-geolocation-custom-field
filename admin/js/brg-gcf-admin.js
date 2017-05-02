var markers = [];
//temporary fix for the bug that converts numbers to string in wp_localize_script
//more info: https://core.trac.wordpress.org/ticket/25280
mapOptions.zoom = +mapOptions.zoom;
for(var i = 0; i < mapOptions; i++){	
	var obj = mapOptions[i];
	for(var prop in obj){
        if(obj.hasOwnProperty(prop) && !isNaN(obj[prop])){
            obj[prop] = +obj[prop];   
        }
    }	
}

//load map to edit screen
function editMap() {
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	var geocoder = new google.maps.Geocoder();	
	
	jQuery('#addlocal').on('click', function(){
		
		var total = jQuery('.local_wrap').length;
		var id = total == undefined ? 1 : total + 1;	
		var end = '<div class="local_wrap"><p>Local '+id+'<div class="local-input-wrap"><input class="local" name="local['+id+'][address]" data-marker="'+id+'" type="textbox" placeholder="Local"><input name="local['+id+'][title]" type="textbox" placeholder="Title"> <input name="local['+id+'][description]" type="textbox" placeholder="Description"><input name="local['+id+'][lat]" id="lat'+id+'" type="hidden" value="0"><input id="lng'+id+'" name="local['+id+'][lng]" type="hidden" value="0"></p></div></div>';
		jQuery('#locals_wrapper').append(end);	
		jQuery('.local').on('blur', function() {
		  var address = jQuery(this).val();
		  var markerid = jQuery(this).data('marker');
		  if (markers[markerid] != undefined){
			markers[markerid].setMap(null);
		  }
		  codeAddress(geocoder, map, address, markerid);
		});
	});
	
  }

//add pin to map from address
function codeAddress(geocoder, resultsMap, address, id) {
	var icon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld="+id+"|FE6256|000000";
	geocoder.geocode({'address': address}, function(results, status) {
	  if (status === 'OK') {
		resultsMap.setCenter(results[0].geometry.location);
		var marker = new google.maps.Marker({
		  map: resultsMap,
		  position: results[0].geometry.location,
		  draggable:true,
		  icon: icon,
		});
		markers[id] = marker;
		marker.id = id;
		jQuery('#lat'+id).val(marker.getPosition().lat());
		jQuery('#lng'+id).val(marker.getPosition().lng());
		google.maps.event.addListener(marker, 'dragend', function (event) {
			jQuery('#lat'+id).val(this.getPosition().lat()); 
			jQuery('#lng'+id).val(this.getPosition().lng()); 
		});		
	  } else {
		alert('N&atilde;o foi poss&iacute;vel encontrar o endere&ccedil;o digitado. Tente digitar um endere&ccedil;o próximo e arrastar o marcador para o local exato');
	  }
	});
}


