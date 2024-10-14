"use strict";

// Mode Switcher
$("#modeSwitcher").on("click", function (e) {
    e.preventDefault();
    modeSwitch();
    location.reload();
});

// Collapse Sidebar
$(".collapseSidebar").on("click", function (e) {
    if ($(".vertical").hasClass("narrow")) {
        $(".vertical").toggleClass("open");
    } else {
        $(".vertical").toggleClass("collapsed");
        if ($(".vertical").hasClass("hover")) {
            $(".vertical").removeClass("hover");
        }
    }
    e.preventDefault();
});

// Sidebar hover effect
$(".sidebar-left").hover(
    function () {
        if ($(".vertical").hasClass("collapsed")) {
            $(".vertical").addClass("hover");
        }
        if (!$(".narrow").hasClass("open")) {
            $(".vertical").addClass("hover");
        }
    },
    function () {
        if ($(".vertical").hasClass("collapsed")) {
            $(".vertical").removeClass("hover");
        }
        if (!$(".narrow").hasClass("open")) {
            $(".vertical").removeClass("hover");
        }
    }
);

// Toggle sidebar in navbar
$(".toggle-sidebar").on("click", function () {
    $(".navbar-slide").toggleClass("show");
});

// Dropdown submenu handling
(function (a) {
    a(".dropdown-menu a.dropdown-toggle").on("click", function (e) {
        if (!a(this).next().hasClass("show")) {
            a(this).parents(".dropdown-menu").first().find(".show").removeClass("show");
        }
        a(this).next(".dropdown-menu").toggleClass("show");
        a(this).parents("li.nav-item.dropdown.show").on("hidden.bs.dropdown", function (e) {
            a(".dropdown-submenu .show").removeClass("show");
        });
        return false;
    });
})(jQuery);

// Remove dropdown show classes on hidden event
$(".navbar .dropdown").on("hidden.bs.dropdown", function () {
    $(this).find("li.dropdown").removeClass("show open");
    $(this).find("ul.dropdown-menu").removeClass("show open");
});

// File panel card selection
$(".file-panel .card").on("click", function () {
    if ($(this).hasClass("selected")) {
        $(this).removeClass("selected").find("bg-light").removeClass("shadow-lg");
        $(".file-container").removeClass("collapsed");
    } else {
        $(this).addClass("selected shadow-lg");
        $(".file-panel .card").not(this).removeClass("selected");
        $(".file-container").addClass("collapsed");
    }
});

// Close file container
$(".close-info").on("click", function () {
    if ($(".file-container").hasClass("collapsed")) {
        $(".file-container").removeClass("collapsed");
        $(".file-panel").find(".selected").removeClass("selected");
    }
});

// Sticky info content
$(function () {
    $(".info-content").stickOnScroll({
        topOffset: 0,
        setWidthOnStick: true
    });
});


// Chart options and data
var ChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: false
    },
    scales: {
        xAxes: [{ gridLines: { display: false } }],
        yAxes: [{ gridLines: { display: false, color: colors.borderColor, zeroLineColor: colors.borderColor } }]
    }
};

// Bar chart data
var ChartData = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
    datasets: [
        {
            label: "Visitors",
            barThickness: 10,
            backgroundColor: base.primaryColor,
            borderColor: base.primaryColor,
            data: [28, 48, 40, 19, 64, 27, 90, 85, 92],
            fill: "",
            lineTension: 0.1
        },
        {
            label: "Orders",
            barThickness: 10,
            backgroundColor: "rgba(210, 214, 222, 1)",
            borderColor: "rgba(210, 214, 222, 1)",
            data: [65, 59, 80, 42, 43, 55, 40, 36, 68],
            fill: "",
            borderWidth: 2,
            lineTension: 0.1
        }
    ]
};

// Initialize bar chart
var barChartjs = document.getElementById("barChartjs");
if (barChartjs) {
    new Chart(barChartjs, { type: "bar", data: ChartData, options: ChartOptions });
}

// Initialize line chart
var lineChartjs = document.getElementById("lineChartjs");
if (lineChartjs) {
    new Chart(lineChartjs, { type: "line", data: lineChartData, options: ChartOptions });
}

// Initialize pie chart
var pieChartjs = document.getElementById("pieChartjs");
if (pieChartjs) {
    new Chart(pieChartjs, { type: "pie", data: pieChartData, options: { maintainAspectRatio: false, responsive: true } });
}

// Initialize area chart
var areaChartjs = document.getElementById("areaChartjs");
if (areaChartjs) {
    new Chart(areaChartjs, { type: "line", data: areaChartData, options: ChartOptions });
}

// Sparkline charts
if ($(".sparkline").length) {
    $(".inlinebar").sparkline([3, 2, 7, 5, 4, 6, 8], { type: "bar", width: "100%", height: "32", barColor: base.primaryColor, barWidth: 4, barSpacing: 2 });
    $(".inlineline").sparkline([2, 0, 5, 7, 4, 6, 8], { type: "line", width: "100%", height: "32", lineColor: base.primaryColor, fillColor: "transparent", lineWidth: 2 });
    $(".inlinepie").sparkline([5, 7, 4, 6, 8], { type: "pie", height: "32", width: "32", sliceColors: chartColors });
}

// Gauge initialization
var gauge1, gauge2, gauge3, gauge4;
var svgg1 = document.getElementById("gauge1");
if (svgg1) {
    gauge1 = Gauge(svgg1, {
        max: 100,
        dialStartAngle: -90,
        dialEndAngle: -90.001,
        value: 100,
        showValue: false,
        label: function (e) { return Math.round(100 * e) / 100; },
        color: function (e) {
            return e < 20 ? base.primaryColor : e < 40 ? base.successColor : e < 60 ? base.warningColor : base.dangerColor;
        }
    });
    function updateGauge1() {
        gauge1.setValue(90);
        gauge1.setValueAnimated(30, 1);
        window.setTimeout(updateGauge1, 6000);
    }
    updateGauge1();
}

var svgg2 = document.getElementById("gauge2");
if (svgg2) {
    gauge2 = Gauge(svgg2, { max: 100, value: 46, dialStartAngle: 0, dialEndAngle: -90.001 });
    function updateGauge2() {
        gauge2.setValue(40);
        gauge2.setValueAnimated(30, 1);
        window.setTimeout(updateGauge2, 6000);
    }
    updateGauge2();
}

var svgg3 = document.getElementById("gauge3");
if (svgg3) {
    gauge3 = Gauge(svgg3, { max: 100, dialStartAngle: -90, dialEndAngle: -90.001, value: 80, showValue: false });
}

var svgg4 = document.getElementById("gauge4");
if (svgg4) {
    gauge4 = Gauge(svgg4, { max: 500, dialStartAngle: 90, dialEndAngle: -90.001, value: 320, showValue: false });
}
