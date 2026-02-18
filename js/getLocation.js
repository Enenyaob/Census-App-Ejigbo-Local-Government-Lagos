(function () {

    const statusBox = document.getElementById("gps-status");
    const latField = document.getElementById("latitude");
    const lngField = document.getElementById("longitude");
    const accField = document.getElementById("gps_accuracy");

    function setStatus(msg, isError = false) {
        if (!statusBox) return;
        statusBox.textContent = msg;
        statusBox.className = isError
            ? "form-text text-danger"
            : "form-text text-success";
    }

    if (!navigator.geolocation) {
        setStatus("Geolocation not supported by this browser.", true);
        return;
    }

    function captureLocation() {

        setStatus("Requesting location permission...");

        navigator.geolocation.getCurrentPosition(

            function success(position) {
                const coords = position.coords;

                if (coords.accuracy > 250) {
                    setStatus("GPS accuracy too low — move outdoors.", true);
                    return;
                }

                if (latField) latField.value = coords.latitude;
                if (lngField) lngField.value = coords.longitude;
                if (accField && coords.accuracy != null)
                    accField.value = coords.accuracy.toFixed(2);

                setStatus(
                    "Location captured ✓ (accuracy ≈ " +
                    Math.round(coords.accuracy) + "m)"
                );
            },

            function error(err) {
                let msg = "Location unavailable";

                switch (err.code) {
                    case err.PERMISSION_DENIED:
                        msg = "Location permission denied — enable it.";
                        break;
                    case err.POSITION_UNAVAILABLE:
                        msg = "Location data unavailable.";
                        break;
                    case err.TIMEOUT:
                        msg = "Location request timed out.";
                        break;
                }

                setStatus(msg, true);
            },

            {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0
            }
        );
    }

    captureLocation();

})();