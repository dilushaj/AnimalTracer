var map;

function initialize() {
    // Create a map centered in Pyrmont, Sydney (Australia).
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 7.8735, lng: 80.7731},
        zoom: 8
    });


    /*function searchPlace(){
        var place = document.getElementById("place").value;
        window.alert(place);*/
    var request = {
        location: map.getCenter(),
        radius: '500',
        query: 'Udawalawe National Park',
    };

    var service = new google.maps.places.PlacesService(map);
    service.textSearch(request, callback);

}

// Checks that the PlacesServiceStatus is OK, and adds a marker
// using the place ID and location from the PlacesService.
function callback(results, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
        var marker = new google.maps.Marker({
            map: map,
            place: {
                placeId: results[0].place_id,
                location: results[0].geometry.location
            }
        });
    }
}

google.maps.event.addDomListener(window, 'load', initialize);/**
 * Created by Dilusha on 2/12/2018.
 */
