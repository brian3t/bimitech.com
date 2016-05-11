window.addEventListener('DOMContentLoaded', function() {
    "use strict";
    var ql = new QueryLoader2(document.querySelector("body"), {
        barColor: "#000",
        backgroundColor: "#fff",
        percentage: true,
        barHeight: 1,
        minimumTime: 300,
        fadeOutTime: 1000
    });
});
