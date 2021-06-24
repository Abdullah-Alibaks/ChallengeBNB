//Deze JS code kun je laten staan :))

let markers = [];
for (var i = 0; i < coordinates.length; i++) {
   var marker = L.marker(coordinates[i]).addTo(mymap);

    markers.push(marker);
    marker.bindPopup(bubbleTexts[i]);
}