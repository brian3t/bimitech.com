<?php
// disable direct access to the file	
defined('ESENSE_WP') or die('Access denied');	

function esense_googlemapstyle($style){
	$gstyles = array( 'lightgray' => 'styles: [
    {
        "featureType": "landscape",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 65
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 51
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 30
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 40
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -100
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ffff00"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -97
            }
        ]
    }
],',
					  'darkgray' => 'styles: [
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 17
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 17
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 29
            },
            {
                "weight": 0.2
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 18
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#000000"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "saturation": 36
            },
            {
                "color": "#000000"
            },
            {
                "lightness": 40
            }
        ]
    },
    {
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 19
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 17
            },
            {
                "weight": 1.2
            }
        ]
    }
],',
					  'nightblue' => 'styles: [
                    {
                        stylers: [
                            { hue: "#00b1ff" },
                            {invert_lightness: true}
                            
                        ]
                    },
                    {
                        featureType: "water",
                        stylers: [
                            { hue: "#009aff" },
                            { saturation: 75 },
                            { lightness: -64 }
                        ]
                    },
                    {
                        featureType: "administrative",
                        elementType: "geometry",
                        stylers: [
                            { visibility: "off" }
                        ]
                    }, 
                     {
                        featureType: "administrative", 
                        elementType: "labels",
                        stylers: [
                            
                            { hue: "#00bfff" },
                            { saturation: 38 },
                            { lightness: -50 }
                        ]
                    },
                    {
                        featureType: "administrative.province", 
                        elementType: "labels",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },                    
                    {
                        featureType: "landscape.man_made", 
                       stylers: [
                            
                            { hue: "#00bfff" },
                            { saturation: 48 },
                            { lightness: -5  }
                        ]
                    },
                    {
                        featureType: "landscape.natural",
                        stylers: [
                            
                            { hue: "#00bfff" },
                            { saturation: 48 },
                            { lightness: 5  }
                        ]
                    },
                    {
                        featureType: "administrative.land_parcel",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "administrative.neighborhood", 
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "landscape.man_made",
                        elementType: "labels",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "poi",
                        elementType: "geometry",
                        stylers: [
                            { hue: "#00bfff" },
                            { saturation: 18 },
                            { lightness: -99  },
                            {gamma : 4}
                        ]
                    },
                    {
                        featureType: "poi.medical",
                        elementType: "geometry",
                        stylers: [
                            { visibility: "on" },
                            { lightness: -10  }
                        ]
                    },
                    {
                        featureType: "poi.government",
                        elementType: "geometry",
                        stylers: [
                            { hue: "#00bfff" },
                            { saturation: 28 },
                            { lightness: 4  }
                        ]
                    },
                    {
                        featureType: "poi.attraction",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "poi.business",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "poi.government",
                        elementType: "labels",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "poi.government",
                        elementType: "geometry",
                        stylers: [
                            { hue: "#00bfff" },
                            { saturation: 28 },
                            { lightness: -30  }
                        ]
                    },
                    {
                        featureType: "poi.park",
                        elementType: "labels",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [
                            { hue: "#00bfff" },
                            { saturation: 28 },
                            { lightness: -30  }
                        ]
                    },
                    {
                        featureType: "poi.place_of_worship",
                        elementType: "labels",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "poi.school",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "poi.sports_complex",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "road.local",
                        elementType: "labels",
                        stylers: [
                            
                            { hue: "#00bfff" },
                            { saturation: 48 },
                            { lightness: -60  }
                        ]
                    },
                    {
                        featureType: "road.local",
                        elementType: "geometry",
                        stylers: [
                            {visibility:"simplified"}
                        ]
                    },
                   
                    {
                        featureType: "road.arterial",
                        elementType: "labels",
                        stylers: [
                            
                            { hue: "#00bfff" },
                            { saturation: 28 },
                            { lightness: -60  }
                        ]
                    },
                    {
                        featureType: "road.arterial",
                        elementType: "geometry",
                        stylers: [
                            { visibility: "simplified" },
                            { hue: "#00bfff" },
                            { saturation: 28 },
                            { lightness: -70  }
                        ]
                    },
                   
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [
                            { visibility: "simplified" },
                            { hue: "#00bfff" },
                            { saturation: 38 },
                            { lightness: -60  }
                        ]
                    },
                    
                    {
                        featureType: "road.highway",
                        elementType: "labels",
                        stylers: [
                            { hue: "#00bfff" },
                            { saturation: 28 },
                            { lightness: -70  }
                            
                        ]
                    },
                    
                    {
                        featureType: "transit",
                        elementType: "geometry",
                        stylers: [
                            { visibility: "off" }
                        ]
                    },
                    {
                        featureType: "transit",
                        elementType: "labels",
                        stylers: [
                            { visibility: "simplified" },
                            { hue: "#00bfff" },
                            { saturation: 18 },
                            { lightness: -50 }
                        ]
                    }
                    
                ],',
					  'fresh'  => 'styles: [
                    {
                        featureType: "water",
                        stylers: [
                            {hue: "#0096ff"},
                            {saturation: 39},
                            {lightness: -8}
                        ]
                    },
                    {
                        featureType: "landscape.man_made",
                        elementType: "geometry",
                        stylers: [
                            {visibility: "on"},
                            {hue: "#ff8000"},
                            {saturation: 2},
                            {lightness: -4}
                        ]
                    },
                    {
                        featureType: "administrative.land_parcel",
                        stylers: [
                            {visibility: "off"}

                        ]
                    },
                    {
                        featureType: "administrative.neighborhood",
                        stylers: [
                            {visibility: "off"}
                        ]
                    },
                    {
                        featureType: "landscape.man_made",
                        elementType: "labels",
                        stylers: [
                            {visibility: "off"}
                        ]
                    },
                    {
                        featureType: "poi.park",
                        stylers: [
                            {hue: "#91ff00"},
                            {saturation: 15},
                            {lightness: 0}
                        ]
                    },
                    {
                        featureType: "poi.business",
                        stylers: [
                            {visibility: "off"}
                        ]
                    },
                    {
                        featureType: "poi.sports_complex",
                        elementType: "labels",
                        stylers: [
                            {visibility: "off"}
                        ]
                    },
                    {
                        featureType: "poi.government",
                        elementType: "labels",
                        stylers: [
                            {visibility: "off"}
                        ]
                    },
                    {
                        featureType: "poi.medical",
                        elementType: "labels",
                        stylers: [
                            {visibility: "off"}
                        ]
                    },
                    { 
                        featureType: "road", 
                        elementType: "labels",
                        stylers: [ 
                            {hue: "#000000"},
                            {saturation: -100},
                            {gamma: 2},
                            {lightness: "10"} 
                        ]},
                    
                    {
                        featureType: "road.arterial",
                        elementType: "geometry",
                        stylers: [
                            {visibility: "simplified"},
                            {saturation: 59},
                            {hue: "#00fff7"},
                            {lightness: 87},
                            {gamma: 3.82}
                        ]
                    },

                    { 
                        featureType: "road.local", 
                        elementType: "labels",
                        stylers: [ 
                            {visibility: "off"}
                            
                        ]},
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [
                            {visibility: "on"},
                            {saturation: 59},
                            {hue: "#00fff7"},
                            {lightness: 87},
                            {gamma: 3.82}
                        ]
                    },
                    {
                        featureType: "transit",
                        stylers: [
                            {visibility: "off"}
                        ]
                    },
                    {
                        featureType: "poi.place_of_worship",
                        elementType: "labels",
                        stylers: [
                            {visibility: "off"}
                        ]
                    }
                ],',
					  'pastel' => 'styles: [
    {
        "featureType": "water",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#acbcc9"
            }
        ]
    },
    {
        "featureType": "landscape",
        "stylers": [
            {
                "color": "#f2e5d4"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#c5c6c6"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#e4d7c6"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#fbfaf7"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#c5dac6"
            }
        ]
    },
    {
        "featureType": "administrative",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": 33
            }
        ]
    },
    {
        "featureType": "road"
    },
    {
        "featureType": "poi.park",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": 20
            }
        ]
    },
    {},
    {
        "featureType": "road",
        "stylers": [
            {
                "lightness": 20
            }
        ]
    }
],',
					  'vintage' => 'styles: [
    {
        "featureType": "administrative",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "landscape",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "color": "#84afa3"
            },
            {
                "lightness": 52
            }
        ]
    },
    {
        "stylers": [
            {
                "saturation": -17
            },
            {
                "gamma": 0.36
            }
        ]
    },
    {
        "featureType": "transit.line",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#3f518c"
            }
        ]
    }
],',
					  'aple' => 'styles: [
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#a2daf2"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f7f1df"
            }
        ]
    },
    {
        "featureType": "landscape.natural",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#d0e3b4"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#bde6ab"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.medical",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#fbd3da"
            }
        ]
    },
    {
        "featureType": "poi.business",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffe15f"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#efd151"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "black"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#cfb2db"
            }
        ]
    }
],',
          	);
	return $gstyles[$style];	
}
?>