<div id="map" class="h-96 w-full"></div>
<script>
  function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: {{ $lat ?? 0 }}, lng: {{ $lng ?? 0 }} },
      zoom: 8,
    });

    // Add marker on click
    map.addListener("click", (e) => {
      new google.maps.Marker({
        position: e.latLng,
        map: map,
      });
      // Update form fields
      document.getElementById("latitude").value = e.latLng.lat();
      document.getElementById("longitude").value = e.latLng.lng();
    });
  }
</script>
<script
  src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=places"
  async defer>
</script>
