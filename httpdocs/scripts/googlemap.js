google.load("maps", "2");
      // Call this function when the page has been loaded
      function initialize() {
        var map = new google.maps.Map2(document.getElementById("map"));
		map.addControl(new GSmallMapControl());
        map.setCenter(new google.maps.LatLng(36.91564, -111.46033), 15);
		var point = new GLatLng(36.91375, -111.459);
		var marker = new GMarker(point);
		map.addOverlay(marker);

		marker.openInfoWindowHtml("<div style='width:210px'><div style='float:right;margin-right:12px;margin-top:7px;border:#7bbce8 2px solid;'><img src='images/base_media.jpg'></div><div style='float:left'><strong>H20-Zone, Inc.</strong><br/>136 6th Avenue<br/>Page, AZ &nbsp;86040<br/><a href='http://maps.google.com/maps?f=d&source=s_d&saddr=&daddr=136+6th+Avenue,+Page,+AZ+86040&hl=en&geocode=&mra=prev&sll=36.914215,-111.459399&sspn=0.014737,0.016372&ie=UTF8&z=16' target='_blank'>Get directions</a></div></div>");

      }
      google.setOnLoadCallback(initialize);
