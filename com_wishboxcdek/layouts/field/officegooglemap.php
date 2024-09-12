<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */

extract($displayData);
?>
<?php /*<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script> */ ?>
<script src="https://unpkg.com/@googlemaps/markerclusterer@2.5.3/dist/index.min.js"></script>
<script>
    (g=>
        {
            var h,
                a,
                k,
                p="The Google Maps JavaScript API",
                c="google",
                l="importLibrary",
                q="__ib__",
                m=document,
                b=window;
            b=b[c]||(b[c]={});
            var d=b.maps||(b.maps={}),
                r=new Set;
            var  e=new URLSearchParams,
                u=()=>h||(
                    h=new Promise(
                        async(f,n)=>{
                            await (a=m.createElement("script"));
                            e.set("libraries",[...r]+"");
                            for(k in g)
                                e.set(
                                    k.replace(/[A-Z]/g, t=>"_"+t[0].toLowerCase()),
                                    g[k]
                                );
                            e.set("callback",c+".maps."+q);
                                a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;
                            a.onerror=()=>h=n(Error(p+" could not load."));
                            a.nonce=m.querySelector("script[nonce]")?.nonce||"";
                            m.head.append(a)
                        }
                        )
                );
            d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
        key: "AIzaSyCOvAjEzM7lafmlz5E1UtKr_bXEokfm1HM",
        v: "weekly",
        // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
        // Add other bootstrap parameters as needed, using camel case.
    });
</script>

<script>
    let map<?php echo $field->id; ?>;
    // initMap is now async
    async function initMap() {

        // Request needed libraries.
        const { Map, InfoWindow } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");

        map<?php echo $field->id; ?> = new Map(document.getElementById("map"), {
            center: { lat: <?php echo $center['lat']; ?>, lng: <?php echo $center['lng']; ?> },
            zoom: 8,
            mapId: "DEMO_MAP_ID",
        });

        const infoWindow = new google.maps.InfoWindow({
            content: "",
            disableAutoPan: true,
        });

        const markersByCode = [];
        const markers = [];
        const bounds = new google.maps.LatLngBounds();
        const fancySelectElement = document.getElementById('jform_shipping_officeCode').closest('joomla-field-fancy-select');
        const fancySelectInstance = fancySelectElement.choicesInstance;

        for (let key in locations)
        {
            const marker = new google.maps.marker.AdvancedMarkerElement
            (
                {
                    position: {
                        lat: locations[key].lat,
                        lng: locations[key].lng
                    },
                    title: locations[key].name,
                }
            );
            bounds.extend({
                lat: locations[key].lat,
                lng: locations[key].lng
            });
            marker.addListener(
                "click",
                () =>
                {
                    infoWindow.setContent(locations[key].name);
                    infoWindow.open(map<?php echo $field->id; ?>, marker);
                    fancySelectInstance.setChoiceByValue(locations[key].code);
                }
            );

            markersByCode[locations[key].code] = marker;

            markers.push(marker);
        }

        const markerCluster = new markerClusterer.MarkerClusterer(
            {
                map: map<?php echo $field->id; ?>,
                markers: markers
            }
        );

        map<?php echo $field->id; ?>.fitBounds(bounds);

        if (fancySelectElement.value != "")
        {
            infoWindow.setContent(locations['PSHK29'].name);
            infoWindow.open(map<?php echo $field->id; ?>, markersByCode['PSHK29']);
        }
    }

    const locations = {
	    <?php foreach ($markers as $k => $marker) : ?>
	    "<?php echo $marker['code']; ?>": {
            lat: <?php echo $marker['lat']; ?>,
            lng: <?php echo $marker['lng']; ?>,
            name: "<?php echo $marker['name']; ?>",
            code: "<?php echo $marker['code']; ?>"
        },
	    <?php endforeach; ?>
    };

    initMap();
</script>

<div id="map" style="height: 400px; width: 100%;"></div>