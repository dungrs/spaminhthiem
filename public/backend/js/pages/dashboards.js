"use strict";
var Dashboard = {
    getChartColorsArray: function(id) {
        if ($("#" + id).length > 0) {
            var colors = $("#" + id).attr("data-colors");
            return JSON.parse(colors).map(function(color) {
                var cleanedColor = color.replace(" ", "");
                if (cleanedColor.indexOf(",") === -1) {
                    var computedColor = getComputedStyle(document.documentElement).getPropertyValue(cleanedColor);
                    return computedColor || cleanedColor;
                }
                var splitColor = color.split(",");
                return splitColor.length != 2 ? cleanedColor : "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(splitColor[0]) + "," + splitColor[1] + ")";
            });
        }
    },

    changeChartType: function() {
        $(document).on('click', '.chartButton', function(e) {
            e.preventDefault();
            let button = $(this);
            let chartType = button.data('chart');
            let url = '/ajax/order/chart';
            
            if (button.hasClass('active')) return;
            
            $('.chartButton').removeClass('active');
            button.addClass('active');
            
            let dropdownText = button.text();
            $('.chart-toggle .text-muted').html(dropdownText + '<i class="mdi mdi-chevron-down ms-1"></i>');
            
            Dashboard.fetchChartData(chartType, url);
        });
    },

    changeDonutChartType: function() {
        $(document).on('click', '.pieChartButton', function(e) {
            e.preventDefault();
            let button = $(this);
            let chartType = button.data('chart');
            let url = '/ajax/order/donutChart';
            
            if (button.hasClass('active')) return;
            
            $('.pieChartButton').removeClass('active');
            button.addClass('active');
            
            let dropdownText = button.text();
            $('.donut-chart-toggle .text-muted').html(dropdownText + '<i class="mdi mdi-chevron-down ms-1"></i>');
            
            Dashboard.fetchDonutChartData(chartType, url);
        });
    },
    
    initChartDropdown: function() {
        let activeButton = $('.chartButton.active').first();
        if (activeButton.length) {
            let dropdownText = activeButton.text();
            $('.chart-toggle .text-muted').html(dropdownText + '<i class="mdi mdi-chevron-down ms-1"></i>');
            $('.donut-chart-toggle .text-muted').html(dropdownText + '<i class="mdi mdi-chevron-down ms-1"></i>');
            
            let chartType = activeButton.data('chart');
            let urlChart = '/ajax/order/chart';
            let urlDonutChart = '/ajax/order/donutChart';
            Dashboard.fetchChartData(chartType, urlChart);
            Dashboard.fetchDonutChartData(chartType, urlDonutChart);
        }
    },
    
    fetchChartData: function(chartType, url) {
        let options = {
            chartType: chartType
        };
        $.ajax({
            url: url,
            type: 'GET',
            data: options,
            dataType: 'json',
            success: function(res) {
                Dashboard.initializeColumnChart(res.chart.data, res.chart.label);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching chart data:', textStatus, errorThrown);
            }
        });
    },

    fetchDonutChartData: function(chartType, url) {
        let options = {
            chartType: chartType
        };
        $.ajax({
            url: url,
            type: 'GET',
            data: options,
            dataType: 'json',
            success: function(res) {
                Dashboard.initializeDonutChart(res.dataDonutChart);
                Dashboard.updateAllOrderStatuses(res.dataDonutChart);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching chart data:', textStatus, errorThrown);
            }
        });
    },
    
    initializeColumnChart: function(data, label) {
        if (window.columnChart) {
            window.columnChart.destroy();
        }
        
        var chartBarColors = this.getChartColorsArray("column_chart");
        var options = {
            chart: {
                height: 410,
                type: "bar",
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    }
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    horizontal: false,
                    columnWidth: "64%",
                    endingShape: "rounded"
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            series: [{
                name: "Doanh thu",
                data: data
            }],
            colors: chartBarColors,
            xaxis: {
                categories: label
            },
            grid: {
                borderColor: "#f1f1f1"
            },
            fill: {
                opacity: 1
            },
            legend: {
                show: false
            },
            tooltip: {
                y: {
                    formatter: function(e) {
                        return e.toLocaleString() + " VND";
                    }
                }
            }
        };
        
        window.columnChart = new ApexCharts($("#column_chart")[0], options);
        window.columnChart.render();
    },
    
    updateAllOrderStatuses: function(data) {
        $('.completed-orders-count').text((data.current.completed_orders ?? 0).toLocaleString());
        $('.completed-orders-change')
            .text((data.percentage_change.completed_orders > 0 ? '+' : '') + (data.percentage_change.completed_orders ?? 0) + '%')
            .removeClass('bg-primary bg-success bg-danger')
            .addClass((data.percentage_change.completed_orders ?? 0) >= 0 ? 'bg-primary' : 'bg-danger');
    
        $('.processing-orders-count').text((data.current.processing_orders ?? 0).toLocaleString());
        $('.processing-orders-change')
            .text((data.percentage_change.processing_orders > 0 ? '+' : '') + (data.percentage_change.processing_orders ?? 0) + '%')
            .removeClass('bg-primary bg-success bg-danger')
            .addClass((data.percentage_change.processing_orders ?? 0) >= 0 ? 'bg-success' : 'bg-danger');
    
        $('.canceled-orders-count').text((data.current.canceled_orders ?? 0).toLocaleString());
        $('.canceled-orders-change')
            .text((data.percentage_change.canceled_orders > 0 ? '+' : '') + (data.percentage_change.canceled_orders ?? 0) + '%')
            .removeClass('bg-primary bg-success bg-danger')
            .addClass((data.percentage_change.canceled_orders ?? 0) >= 0 ? 'bg-danger' : 'bg-success');
    },

    initializeDonutChart: function(dataDonutChart) {
        let dataValue = dataDonutChart.current;
        var chartBarColors = this.getChartColorsArray("chart-donut");
    
        var options = {
            chart: {
                height: 287,
                type: "donut"
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "75%"
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            series: [
                dataValue.completed_orders,
                dataValue.processing_orders,
                dataValue.canceled_orders
            ],
            labels: ["Completed", "Processing", "Cancel"],
            colors: chartBarColors,
            legend: {
                show: false
            }
        };
    
        if (this.donutChart) {
            this.donutChart.destroy();
        }
    
        this.donutChart = new ApexCharts($("#chart-donut")[0], options);
        this.donutChart.render();
    },

    sendDataFilter: function (page = 1) {
        let dataFilterSend = { page: page };

        $.ajax({
            url: '/ajax/order/filter',
            type: 'GET',
            data: dataFilterSend,
            dataType: 'json',
            success: function (response) {
                const tbody = $('.data-table');
                tbody.empty();
                
                response.data.data.forEach(item => {
                    const formattedPrice = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(item.cart.cartTotal);
    
                    const paymentStat = paymentStatus[item.payment] || 
                        { label: item.payment, icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };
    
                    const confirmStat = confirmMethods[item.confirm] || 
                        { label: item.confirm_status || 'Chưa xác nhận', icon: 'fas fa-question-circle', class: 'bg-secondary bg-opacity-10 text-secondary' };
    
                    tbody.append(`
                        <tr>
                            <td class="ps-4 fw-semibold text-primary">
                                <a href="${Config.baseUrl}/order/details/${item.code}">#DH${item.code}</a>
                            </td>
                            <td>${item.fullname}</td>
                            <td class="fw-semibold">${formattedPrice}</td>
                            <td>
                                <span class="badge ${paymentStat.class}">
                                    <i class="${paymentStat.icon} me-1"></i> ${paymentStat.label}
                                </span>
                            </td>
                            <td>
                                <span class="badge ${confirmStat.class}">
                                    <i class="${confirmStat.icon} me-1"></i> ${confirmStat.label}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="${Config.baseUrl}/order/details/${item.code}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    `);
                });
    
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    console.error('Validation Error: ', xhr.responseText);
                } else {
                    console.error('AJAX Error: ', xhr.responseText);
                }
            },
        });
    },

    initializeSalesCountriesChart: function() {
        var options = {
            series: [{
                data: [1040, 1320, 1560, 1280, 1480]
            }],
            chart: {
                type: "bar",
                height: 234,
                toolbar: {
                    show: false
                }
            },
            labels: ["Canada", "Russia", "Brazil", "United States", "Egypt"],
            colors: ["#776acf"],
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    horizontal: true
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: ["Canada", "Russia", "Brazil", "US", "Egypt"]
            }
        };
        var chart = new ApexCharts($("#sales-countries")[0], options);
        chart.render();
    },

    initializeWorldMap: function() {
        new jsVectorMap({
            map: "world_merc",
            selector: "#world-map-markers",
            zoomOnScroll: false,
            zoomButtons: false,
            opacity: 1,
            regionStyle: {
                initial: {
                    fill: "#f0f2f3"
                }
            },
            markerStyle: {
                initial: {
                    fill: "#3cbf87"
                },
                selected: {
                    fill: "#3cbf87"
                }
            },
            markers: [{
                name: "Canada",
                coords: [56.1304, -106.3468]
            }, {
                name: "Brazil",
                coords: [-14.235, -51.9253]
            }, {
                name: "Egypt",
                coords: [26.8206, 30.8025]
            }, {
                name: "Russia",
                coords: [61, 105]
            }, {
                name: "United States",
                coords: [37.0902, -95.7129]
            }],
            lines: [{
                from: "Canada",
                to: "Egypt"
            }, {
                from: "Russia",
                to: "Egypt"
            }, {
                from: "Brazil",
                to: "Egypt"
            }, {
                from: "United States",
                to: "Egypt"
            }],
            lineStyle: {
                animation: true,
                strokeDasharray: "6 3 6"
            }
        });
    },

    initializeSwiper: function() {
        new Swiper(".swiper-container", {
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                576: {
                    slidesPerView: 1,
                    spaceBetween: 30
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                1500: {
                    slidesPerView: 2,
                    spaceBetween: 30
                }
            }
        });
    }
};

$(document).ready(function() {
    Dashboard.initChartDropdown();
    Dashboard.changeChartType();
    Dashboard.changeDonutChartType();
    Dashboard.initChartDropdown();
    Dashboard.initializeSalesCountriesChart();
    Dashboard.initializeWorldMap();
    Dashboard.initializeSwiper();
    Dashboard.sendDataFilter();
});