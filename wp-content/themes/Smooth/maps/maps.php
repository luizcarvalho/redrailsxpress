<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php get_googleapiSubmitionForm();?>"></script> 
<?php
//Google Maps - Initiating Variable
$address = get_post_meta($post->ID, 'address', true);
$city = get_post_meta($post->ID, 'city', true);
$state = get_post_meta($post->ID, 'state', true);
$zip = get_post_meta($post->ID, 'zip', true);
?>
<script type="text/javascript">

//<![CDATA[

function load() { 
if (GBrowserIsCompatible()) { 
  var mapOptions = {
    googleBarOptions : {
      style : "new"
    }
  }
var map = new GMap2(document.getElementById("map"),mapOptions);
map.setMapType(G_HYBRID_MAP);
var geocoder = new GClientGeocoder(); 
map.setUIToDefault();
map.enableGoogleBar();
showaddress(map, geocoder, "<?=$address?> <?=$city?>");
 
} 
}

function showaddress(map, geocoder, address) { 
geocoder.getLatLng( 
address, 
function(latlng) { 
if (!latlng) { 
alert(address + " not found"); 
} else { 
map.setCenter(latlng, 16); 

var marker = new GMarker(latlng); 
map.addOverlay(marker); 
} 
} 
); 
}

//]]> 
</script> 