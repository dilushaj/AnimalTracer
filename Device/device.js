
var map;
var marker;
var coordinates=[];
var marker1;

//load google map
function initMap() {
  var uluru = {lat: 6.4739, lng: 80.8986 };
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: uluru,
  });
  //create map marker
    marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
    marker.addListener('click', toggleBounce);
}

//add animation to marker
function toggleBounce(){
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

//get the GPS reading
function setCoordinates(){
    var latitude = Number(document.getElementById("text-box1").value);//should read from the GPS receiver
    var longitude = Number(document.getElementById("text-box2").value);
    coordinates = [latitude, longitude];
    var latlng = {lat: latitude, lng: longitude};
    marker1 = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: "icons/currentLocation.png",
    });
    setInterval(changeMarkerPosition,200);
}

function changeMarkerPosition(){//changing the position of the marker with time.
    var latlng=getCoordinates();
    var latitude=latlng[0]+0.0001;
    var longitude=latlng[1]+0.0001;
    coordinates=[latitude,longitude];
    var position = new google.maps.LatLng( latitude, longitude);
    marker1.setPosition(position);

}
//return coordinates
function getCoordinates(){
    return coordinates;
}

//make animal popup
function animalInvoke(animal){
    var latlng=getCoordinates();
    var position={lat:latlng[0],lng:latlng[1]};
    connectionAvailable(animal);

    if(animal=="elephant"){
        new google.maps.Marker({
            position: position,
            map: map,
            icon: "icons/elephant.png",

        });
    }else if(animal=="lion"){
         new google.maps.Marker({
            position: position,
            map: map,
            icon: "icons/lion.png",

        });
        marker2.addListener('click', toggleBounce(marker2));
    }else if(animal=="tiger"){
         new google.maps.Marker({
            position: position,
            map: map,
            icon: "icons/tiger.png",

        });
    }else if(animal=="wolf"){
        new google.maps.Marker({
            position: position,
            map: map,
            icon: "icons/wolf.png",

        });

    }else if(animal=="fox"){
        new google.maps.Marker({
            position: position,
            map: map,
            icon: "icons/fox.png",

        });

    }else if(animal=="bear"){
         new google.maps.Marker({
            position: position,
            map: map,
            icon: "icons/bear.png",

        });

    }
}

//send data to the databases according to the connection
function connectionAvailable(animal){
    var latlng=getCoordinates();
    var latitude=latlng[0];
    var longitude=latlng[1];
    if(navigator.onLine){
        alert("Device is online");
        $.ajax({
            type:'Get',
            url: 'localDatabaseAccess.php?latitude='+ latitude + '&longitude=' + longitude + '&animal=' + animal + '&broadcasted=' + "broadcasted",
            success: function () {
                alert('Data saved to Local Database successfully');
            }
        });
        $.ajax({
            type:'Get',
            url: 'webServerAccess.php?latitude='+ latitude + '&longitude=' + longitude + '&animal=' + animal,
            success: function () {
                alert('Data saved to web Server successfully');
            }
        });

    } else{
        alert("Device is offline");
        $.ajax({
            type:'Get',
            url: 'localDatabaseAccess.php?latitude='+ latitude + '&longitude=' + longitude + '&animal=' + animal + '&broadcasted=' + "not broadcasted",
            success: function () {
                alert('Data saved to Local Database successfully');
            }
        });
    }
}




