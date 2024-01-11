/* === Custom Block Scripts === */
jQuery(document).ready(function () {});

async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
  let mapContainers = document.querySelectorAll(".mapContainer");
  const location = { lat: 31.4347, lng: -97.7487 };
  const mapStyle = [
    {
      featureType: "administrative",
      elementType: "geometry",
      stylers: [
        {
          visibility: "off",
        },
      ],
    },
    {
      featureType: "administrative",
      elementType: "labels",
      stylers: [
        {
          hue: "#ff0000",
        },
      ],
    },
    {
      featureType: "administrative",
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#fffbf5",
        },
      ],
    },
    {
      featureType: "administrative",
      elementType: "labels.text.stroke",
      stylers: [
        {
          color: "#902c3a",
        },
      ],
    },
    {
      featureType: "landscape",
      elementType: "geometry",
      stylers: [
        {
          color: "#cbbfad",
        },
      ],
    },
    {
      featureType: "landscape",
      elementType: "labels",
      stylers: [
        {
          visibility: "off",
        },
      ],
    },
    {
      featureType: "landscape.natural",
      elementType: "all",
      stylers: [
        {
          visibility: "on",
        },
      ],
    },
    {
      featureType: "poi",
      elementType: "all",
      stylers: [
        {
          visibility: "off",
        },
      ],
    },
    {
      featureType: "road",
      elementType: "geometry.fill",
      stylers: [
        {
          color: "#902c3a",
        },
      ],
    },
    {
      featureType: "road",
      elementType: "geometry.stroke",
      stylers: [
        {
          color: "#cbbfad",
        },
      ],
    },
    {
      featureType: "road",
      elementType: "labels.text.fill",
      stylers: [
        {
          color: "#fffbf5",
        },
      ],
    },
    {
      featureType: "road",
      elementType: "labels.text.stroke",
      stylers: [
        {
          color: "#902c3a",
        },
      ],
    },
    {
      featureType: "road.local",
      elementType: "all",
      stylers: [
        {
          visibility: "on",
        },
      ],
    },
    {
      featureType: "road.local",
      elementType: "labels",
      stylers: [
        {
          visibility: "off",
        },
      ],
    },
    {
      featureType: "transit",
      elementType: "all",
      stylers: [
        {
          visibility: "off",
        },
      ],
    },
    {
      featureType: "water",
      elementType: "geometry.fill",
      stylers: [
        {
          color: "#e0b07e",
        },
      ],
    },
    {
      featureType: "water",
      elementType: "labels",
      stylers: [
        {
          visibility: "off",
        },
      ],
    },
  ];
  mapContainers.forEach((block) => {
    const homeMarker =
      "/wp-content/plugins/four-columns-custom-bocks/blocks/map-container/cm-spur-pin-sm-white.png";
    let mapContainer = new Map(block.querySelector(".mapContainer__map"), {
      center: location,
      zoom: 14,
      styles: mapStyle,
    });
    // The marker, positioned at Uluru
    let marker = new google.maps.Marker({
      position: location,
      map: mapContainer,
      title: "Coryell Museum",
      icon: homeMarker,
    });
  });
}
