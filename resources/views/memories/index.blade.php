@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
    }

    .custom-marker {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        border: 2px solid #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        position: absolute;
        transform: translate(-50%, -50%);
        cursor: pointer; /* Change cursor to pointer */
    }

    .marker-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .popup-container {
        position: absolute;
        background-color: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        max-width: 250px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .popup-image {
        width: 100%;
        height: auto;
        border-radius: 6px;
        margin-bottom: 5px;
        cursor: pointer; /* Make image clickable */
    }

    .close-button {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: #f87171;
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        cursor: pointer;
        font-weight: bold;
    }

    .close-button:hover {
        background-color: #ef4444;
    }

    #map {
        width: 100%;
        height: 700px;
        max-height: 80vh;
        margin-bottom: 1rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    .map-type-button {
        background-color: #374151;
        color: white;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        margin: 10px;
        transition: background-color 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .map-type-button:hover {
        background-color: #4b5563;
    }
    .popup-container {
        position: fixed;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #fff;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        max-width: 300px;
        text-align: center;
    }

    .popup-title {
        font-size: 1.25rem;
        margin-bottom: 8px;
    }

    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .popup-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }

    .details-link {
        display: inline-block;
        margin-top: 10px;
        padding: 6px 12px;
        background-color: #006d77;
        color: #fff;
        border-radius: 4px;
        text-decoration: none;
    }

    .details-link:hover {
        background-color: #004d56;
    }


    .year-filter-container {
        margin: 20px auto;
        background-color: #005f73;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 6px;
        border-radius: 12px;
        width: 95%;
        max-width: 1200px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    .year-filters {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .year-filters button {
        background-color: #374151; /* Dark gray button color */
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: transform 0.2s, background-color 0.2s;
        white-space: nowrap;
        font-size: 13px;
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    }

    .year-filters button:hover {
        transform: scale(1.05);
        background-color: #4b5563;
    }

    .arrow-button {
        background-color: #374151;
        color: white;
        padding: 4px 6px;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
        font-size: 16px;
        margin: 0 4px;
    }

    .arrow-button:hover {
        background-color: #4b5563;
        transform: scale(1.1);
    }

    .arrow-button:disabled {
        background-color: #6b7280;
        cursor: not-allowed;
    }

    h1 {
        color: #333;
        margin-bottom: 1rem;
        font-size: 24px;
        text-align: center;
    }


    .floating-plus-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #006d77;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, background-color 0.3s ease;
        z-index: 1000;
    }

    .floating-plus-button:hover {
        transform: scale(1.1);
        background-color: #007f91;
    }

    .plus-icon {
        width: 24px;
        height: 24px;
        stroke: white;
        stroke-width: 2;
    }

</style>

<!-- Floating Plus Button -->
<a href="{{ route('memories.create') }}" class="floating-plus-button">
    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" class="plus-icon">
        <path d="M12 5v14m7-7H5"/>
    </svg>
</a>

<div class="w-full max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold">Your Travel Memories</h1>
    <div id="map"></div>

    <!-- Year Filter Container -->
    <div class="year-filter-container">
        <button class="arrow-button" id="leftArrow" onclick="scrollYears(-1)">&lt;</button>
        <div class="year-filters" id="yearFilters"></div>
        <button class="arrow-button" id="rightArrow" onclick="scrollYears(1)">&gt;</button>
    </div>
</div>



<script>
    let map;
    let allMarkers = [];
    let startIndex = 0; // Starting index for the year buttons
    const visibleYearsCount = 2; // Number of years to display along with "All Years"

    const currentYear = new Date().getFullYear();
    const years = {!! json_encode($years) !!};


    // Ensure the current year is included and the list is sorted in descending order
    if (!years.includes(currentYear)) {
        years.unshift(currentYear);
    }
    years.sort((a, b) => b - a);


    async function getImageUrl(memory) {
        const defaultUrl = "/images/default.png";
        const extensions = ["jpg", "png", "jpeg", "gif", "webp"];

        if (memory.photos && memory.photos.length) {
            let photoName = memory.photos[0];
            // Remove any leading slash if present
            photoName = photoName.replace(/^\/+/, '');

            for (const ext of extensions) {
                const imagePath = `/storage/${photoName}`;
                const isValid = await validateImageUrl(imagePath);
                if (isValid) {
                    return imagePath;
                }
            }
        }
        return defaultUrl;
    }

    function validateImageUrl(url) {
        return new Promise((resolve) => {
            const img = new Image();
            img.onload = () => resolve(true);
            img.onerror = () => resolve(false);
            img.src = url;
        });
    }

    async function createMarker(memory, position) {
        const imageUrl = await getImageUrl(memory);

        const markerElement = document.createElement("div");
        markerElement.classList.add("custom-marker");

        const markerImage = document.createElement("img");
        markerImage.classList.add("marker-image");
        markerImage.src = imageUrl;
        markerImage.alt = "Memory Image";
        markerElement.appendChild(markerImage);

        const marker = new google.maps.marker.AdvancedMarkerElement({
            position: position,
            map: map,
            content: markerElement
        });

        marker.memoryYear = new Date(memory.created_at).getFullYear();
        allMarkers.push(marker);

        // Add click event to show popup
        markerElement.addEventListener("click", () => openPopup(memory, position));
    }

    function openPopup(memory, position) {
        // Close any existing popup
        const existingPopup = document.querySelector(".popup-container");
        if (existingPopup) existingPopup.remove();

        // Create the popup container
        const popupContainer = document.createElement("div");
        popupContainer.classList.add("popup-container");

        // Create a close button
        const closeButton = document.createElement("button");
        closeButton.classList.add("close-button");
        closeButton.textContent = "✖";
        closeButton.onclick = () => popupContainer.remove();
        popupContainer.appendChild(closeButton);

        // Add images from memory.photos
        if (memory.photos && memory.photos.length) {
            const imageGrid = document.createElement("div");
            imageGrid.classList.add("image-grid");

            memory.photos.forEach((photo) => {
                let photoPath = photo.replace(/^\/+|\/+$/g, '');
                if (!photoPath.startsWith("storage/images/")) {
                    photoPath = `storage/images/${photoPath}`;
                }

                const imageUrl = `/${photoPath}`;

                const img = document.createElement("img");
                img.src = imageUrl;
                img.alt = "Memory Image";
                img.classList.add("popup-image");

                // Make the image clickable to open the detailed memory page
                img.onclick = () => window.location.href = `/memories/${memory.id}`;
                imageGrid.appendChild(img);
            });

            popupContainer.appendChild(imageGrid);
        } else {
            const noImageText = document.createElement("p");
            noImageText.textContent = "No images available";
            popupContainer.appendChild(noImageText);
        }

        // Append the popup to the document body
        document.body.appendChild(popupContainer);

        // Position the popup near the marker
        popupContainer.style.left = `${position.lng()}px`;
        popupContainer.style.top = `${position.lat()}px`;
    }

    // Close popup when clicking outside
    window.addEventListener("click", (event) => {
        const popup = document.querySelector(".popup-container");
        if (popup && !popup.contains(event.target)) {
            popup.remove();
        }
    });


    function filterMarkers(year) {
        allMarkers.forEach(marker => {
            const markerYear = marker.memoryYear;
            marker.map = (year === 'all' || markerYear === parseInt(year)) ? map : null;
        });
    }
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 3,
            center: { lat: 20, lng: 0 },
            mapId: "{{ env('GOOGLE_MAPS_MAP_ID') }}",
            mapTypeControl: false,  // Disable the default Map/Satellite toggle
            mapTypeId: "roadmap"    // Set the default map type
        });

        const memories = {!! json_encode($memories) !!};
        const bounds = new google.maps.LatLngBounds();

        memories.forEach(async (memory) => {
            const position = new google.maps.LatLng(parseFloat(memory.latitude), parseFloat(memory.longitude));
            await createMarker(memory, position);
            bounds.extend(position);
        });

        if (!bounds.isEmpty()) {
            map.fitBounds(bounds);
        }

        // Add the floating button for switching map types and hiding POI
        addMapTypeToggleButton();
    }

    function addMapTypeToggleButton() {
        const button = document.createElement("div");
        button.classList.add("map-type-button");
        button.textContent = "POI Hidden";
        button.onclick = togglePOI;

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(button);
    }

    function togglePOI() {
        const poiStyles = [
            {
                featureType: "poi",
                stylers: [{ visibility: "off" }]
            },
            {
                featureType: "transit",
                stylers: [{ visibility: "off" }]
            }
        ];

        const defaultStyles = [];

        if (map.get("styles")) {
            map.set("styles", defaultStyles); // Show POIs
            this.textContent = "POI Hidden";
        } else {
            map.set("styles", poiStyles); // Hide POIs
            this.textContent = "Map";
        }
    }

    function updateYearButtons() {
        const yearFilters = document.getElementById("yearFilters");
        yearFilters.innerHTML = ""; // Clear existing buttons

        // Always show the "All Years" button
        yearFilters.innerHTML += `<button onclick="filterMarkers('all')">All Years</button>`;

        // Show the next set of years based on the current index
        for (let i = startIndex; i < Math.min(startIndex + visibleYearsCount, years.length); i++) {
            yearFilters.innerHTML += `<button onclick="filterMarkers(${years[i]})">${years[i]}</button>`;
        }
    }

    function scrollYears(direction) {
        if (direction === 1 && startIndex + visibleYearsCount < years.length) {
            startIndex++;
        } else if (direction === -1 && startIndex > 0) {
            startIndex--;
        }
        updateYearButtons();
    }

    window.onload = function () {
        updateYearButtons();
    };



</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=marker,places&callback=initMap">
</script>





@endsection
