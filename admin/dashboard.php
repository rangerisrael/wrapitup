<?php include 'layouts/header.php';?>
<body>

    <!-- Main navbar -->
    <?php include 'layouts/top-navigation.php';?>
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <?php include 'layouts/navigation.php';?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-light">
                <div class="page-header-content d-sm-flex">
                    <div class="page-title">
                        <h4>Dashboard</h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-sm-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="#" class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> Dashboard</a>
                        </div>
                        <a href="#" class="header-elements-toggle text-body d-sm-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

            

                <!-- Basic card -->
                <div class="row">
                <div class="col-md-3 col-12">
                        <div class="card card-body">
                            <div class="media">
                                <div class="mr-3 align-self-center">
                                    <i class="icon-cart icon-3x text-warning"></i>
                                </div>

                                <div class="media-body text-right">
                                <h3 class="font-weight-semibold mb-0"><?=get_transaction_status(0)?></h3>
                                    <span class="text-uppercase font-size-sm text-muted">Pending</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="card card-body">
                            <div class="media">
                                <div class="mr-3 align-self-center">
                                    <i class="icon-cart icon-3x text-primary"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0"><?=get_transaction_status(1)?></h3>
                                    <span class="text-uppercase font-size-sm text-muted">Processing</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="card card-body">
                            <div class="media">
                                <div class="mr-3 align-self-center">
                                    <i class="icon-cart icon-3x text-success"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0"><?=get_transaction_status(2)?></h3>
                                    <span class="text-uppercase font-size-sm text-muted">Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="card card-body">
                            <div class="media">
                                <div class="mr-3 align-self-center">
                                    <i class="icon-cart icon-3x text-danger"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0"><?=get_transaction_status(3)?></h3>
                                    <span class="text-uppercase font-size-sm text-muted">Cancelled</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="row ">
                    <div class="col-md-3 col-12">
                        <div class="card card-body">
                            <div class="media">
                                <div class="mr-3 align-self-center">
                                    <i class="icon-cash icon-3x text-success"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0">AED&nbsp;<?=get_transaction_sales()?></h3>
                                    <span class="text-uppercase font-size-sm text-muted">Total Sales</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="card card-body">
                            <div class="media">
                                <div class="mr-3 align-self-center">
                                    <i class="icon-users4 icon-3x text-success"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0"><?=get_registered_user()?></h3>
                                    <span class="text-uppercase font-size-sm text-muted">Registered Users</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="card card-body">
                            <div class="media">
                                <div class="mr-3 align-self-center">
                                    <i class="icon-users4 icon-3x text-info"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0"><?=get_visitors()?></h3>
                                    <span class="text-uppercase font-size-sm text-muted">Visitors</span>
                                </div>
                            </div>
                        </div>
                    </div>

                 
                    </div>
                    
                <div class="row">

               
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart" id="google-line"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-container">
                                <div class="chart" id="google-column"></div>
                                </div>
                            </div>
                        </div>
                    </div>
 -->
                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart" id="google-column-signup"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart" id="google-column-visitors"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-container">
                                <div class="chart" id="google-column-gender"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-container">
                                <div class="chart" id="google-column-age"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-container">
                                <div class="chart" id="google-column-location"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-container">
                                <div class="chart" id="google-column-marital"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /basic card -->

            </div>
            <!-- /content area -->


            <!-- Footer -->
            <?php include 'layouts/footer.php';?>
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->
    <?php include 'layouts/scripts.php';?>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script>
        /* ------------------------------------------------------------------------------
         *
         *  # Google Visualization - columns
         *
         *  Google Visualization column chart demonstration
         *
         * ---------------------------------------------------------------------------- */


        // Setup module
        // ------------------------------

        var GoogleColumnBasic = function () {


            //
            // Setup module components
            //

            // Column chart
            var _googleColumnBasic = function () {
                if (typeof google == 'undefined') {
                    console.warn('Warning - Google Charts library is not loaded.');
                    return;
                }

                // Initialize chart
                google.charts.load('current', {
                    callback: function () {

                        // Draw chart
                        drawColumn();

                        // Resize on sidebar width change
                        var sidebarToggle = document.querySelectorAll('.sidebar-control');
                        if (sidebarToggle) {
                            sidebarToggle.forEach(function (togglers) {
                                togglers.addEventListener('click', drawColumn);
                            });
                        }

                        // Resize on window resize
                        var resizeColumn;
                        window.addEventListener('resize', function () {
                            clearTimeout(resizeColumn);
                            resizeColumn = setTimeout(function () {
                                drawColumn();
                            }, 1);
                        });
                    },
                    packages: ['corechart']
                });

                // Chart settings
                // function drawColumn() {

                //     // Define charts element
                //     var line_chart_element = document.getElementById('google-column');
                //     // Data
                //     var data = google.visualization.arrayToDataTable([
                //         ['Year','Cash on Delivery','Bank Transfer','Stripe'],
                //         <?php foreach(get_all_payment_method_used() as $transaction) { ?>
                //             ['<?=date('M',strtotime($transaction['created_at']))?> <?=date('Y',strtotime($transaction['created_at']))?>', <?=count_cod($transaction['month'],$transaction['year'])?>,<?=count_bank_transfer($transaction['month'],$transaction['year'])?>,<?=count_stripe($transaction['month'],$transaction['year'])?>],
                //         <?php } ?>
                //     ]);


                //     // Options
                //     var options_column = {
                //         fontName: 'Roboto',
                //         height: 400,
                //         fontSize: 12,
                //         backgroundColor: 'transparent',
                //         chartArea: {
                //             left: '5%',
                //             width: '100%',
                //             height: 350
                //         },
                //         tooltip: {
                //             textStyle: {
                //                 fontName: 'Roboto',
                //                 fontSize: 13
                //             }
                //         },
                //         vAxis: {
                //             title: 'Payment Methods',
                //             titleTextStyle: {
                //                 fontSize: 13,
                //                 italic: false,
                //                 color: '#333'
                //             },
                //             textStyle: {
                //                 color: '#333'
                //             },
                //             baselineColor: '#ccc',
                //             gridlines: {
                //                 color: '#eee',
                //                 count: 10
                //             },
                //             minValue: 0
                //         },
                //         hAxis: {
                //             textStyle: {
                //                 color: '#333'
                //             }
                //         },
                //         legend: {
                //             position: 'top',
                //             alignment: 'center',
                //             textStyle: {
                //                 color: '#333'
                //             }
                //         },
                //         series: {
                //             0: {
                //                 color: '#2ec7c9'
                //             },
                //             1: {
                //                 color: '#CE614A'
                //             },
                //             2: {
                //                 color: '#859DE8'
                //             }
                //         }
                //     };

                //     // Draw chart
                //     var column = new google.visualization.ColumnChart(line_chart_element);
                //     column.draw(data, options_column);
                   
                // }
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _googleColumnBasic();
                }
            }
        }();

        // Initialize module
        // ------------------------------

        GoogleColumnBasic.init();
    </script>

<script>
        /* ------------------------------------------------------------------------------
         *
         *  # Google Visualization - columns
         *
         *  Google Visualization column chart demonstration
         *
         * ---------------------------------------------------------------------------- */


        // Setup module
        // ------------------------------

        var GoogleColumnBasic = function () {


            //
            // Setup module components
            //

            // Column chart
            var _googleColumnBasic = function () {
                if (typeof google == 'undefined') {
                    console.warn('Warning - Google Charts library is not loaded.');
                    return;
                }

                // Initialize chart
                google.charts.load('current', {
                    callback: function () {

                        // Draw chart
                        drawColumn();

                        // Resize on sidebar width change
                        var sidebarToggle = document.querySelectorAll('.sidebar-control');
                        if (sidebarToggle) {
                            sidebarToggle.forEach(function (togglers) {
                                togglers.addEventListener('click', drawColumn);
                            });
                        }

                        // Resize on window resize
                        var resizeColumn;
                        window.addEventListener('resize', function () {
                            clearTimeout(resizeColumn);
                            resizeColumn = setTimeout(function () {
                                drawColumn();
                            }, 1);
                        });
                    },
                    packages: ['corechart']
                });

                // Chart settings
                function drawColumn() {

                    // Define charts element
                    var line_chart_element = document.getElementById('google-column-gender');
                    // Data
                    var data = google.visualization.arrayToDataTable([
                        ['Year','Male','Female'],
                        <?php foreach(get_all_genders() as $transaction) { ?>
                            ['<?=date('M',strtotime($transaction['created_at']))?> <?=date('Y',strtotime($transaction['created_at']))?>', <?=count_male($transaction['month'],$transaction['year'])?>,<?=count_female($transaction['month'],$transaction['year'])?>],
                        <?php } ?>
                    ]);


                    // Options
                    var options_column = {
                        fontName: 'Roboto',
                        height: 400,
                        fontSize: 12,
                        backgroundColor: 'transparent',
                        chartArea: {
                            left: '5%',
                            width: '100%',
                            height: 350
                        },
                        tooltip: {
                            textStyle: {
                                fontName: 'Roboto',
                                fontSize: 13
                            }
                        },
                        vAxis: {
                            title: 'Gender',
                            titleTextStyle: {
                                fontSize: 13,
                                italic: false,
                                color: '#333'
                            },
                            textStyle: {
                                color: '#333'
                            },
                            baselineColor: '#ccc',
                            gridlines: {
                                color: '#eee',
                                count: 10
                            },
                            minValue: 0
                        },
                        hAxis: {
                            textStyle: {
                                color: '#333'
                            }
                        },
                        legend: {
                            position: 'top',
                            alignment: 'center',
                            textStyle: {
                                color: '#333'
                            }
                        },
                        series: {
                            0: {
                                color: '#2ec7c9'
                            },
                            1: {
                                color: '#CE614A'
                            },
                            2: {
                                color: '#859DE8'
                            }
                        }
                    };

                    // Draw chart
                    var column = new google.visualization.ColumnChart(line_chart_element);
                    column.draw(data, options_column);
                   
                }
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _googleColumnBasic();
                }
            }
        }();

        // Initialize module
        // ------------------------------

        GoogleColumnBasic.init();
    </script>


<script>
        /* ------------------------------------------------------------------------------
         *
         *  # Google Visualization - columns
         *
         *  Google Visualization column chart demonstration
         *
         * ---------------------------------------------------------------------------- */


        // Setup module
        // ------------------------------

        var GoogleColumnBasic = function () {


            //
            // Setup module components
            //

            // Column chart
            var _googleColumnBasic = function () {
                if (typeof google == 'undefined') {
                    console.warn('Warning - Google Charts library is not loaded.');
                    return;
                }

                // Initialize chart
                google.charts.load('current', {
                    callback: function () {

                        // Draw chart
                        drawColumn();

                        // Resize on sidebar width change
                        var sidebarToggle = document.querySelectorAll('.sidebar-control');
                        if (sidebarToggle) {
                            sidebarToggle.forEach(function (togglers) {
                                togglers.addEventListener('click', drawColumn);
                            });
                        }

                        // Resize on window resize
                        var resizeColumn;
                        window.addEventListener('resize', function () {
                            clearTimeout(resizeColumn);
                            resizeColumn = setTimeout(function () {
                                drawColumn();
                            }, 1);
                        });
                    },
                    packages: ['corechart']
                });

                // Chart settings
                function drawColumn() {

                    // Define charts element
                    var line_chart_element = document.getElementById('google-column-age');
                    // Data
                    var data = google.visualization.arrayToDataTable([
                        ['Year','Count'],
                        <?php foreach(get_all_ages() as $transaction) { ?>
                            [<?=$transaction['age']?>,<?=$transaction['count']?>],
                        <?php } ?>
                    ]);


                    // Options
                    var options_column = {
                        fontName: 'Roboto',
                        height: 400,
                        fontSize: 12,
                        backgroundColor: 'transparent',
                        chartArea: {
                            left: '5%',
                            width: '100%',
                            height: 350
                        },
                        tooltip: {
                            textStyle: {
                                fontName: 'Roboto',
                                fontSize: 13
                            }
                        },
                        vAxis: {
                            title: 'Gender',
                            titleTextStyle: {
                                fontSize: 13,
                                italic: false,
                                color: '#333'
                            },
                            textStyle: {
                                color: '#333'
                            },
                            baselineColor: '#ccc',
                            gridlines: {
                                color: '#eee',
                                count: 10
                            },
                            minValue: 0
                        },
                        hAxis: {
                            textStyle: {
                                color: '#333'
                            }
                        },
                        legend: {
                            position: 'top',
                            alignment: 'center',
                            textStyle: {
                                color: '#333'
                            }
                        },
                        series: {
                            0: {
                                color: '#2ec7c9'
                            },
                            1: {
                                color: '#CE614A'
                            },
                            2: {
                                color: '#859DE8'
                            }
                        }
                    };

                    // Draw chart
                    var column = new google.visualization.ColumnChart(line_chart_element);
                    column.draw(data, options_column);
                   
                }
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _googleColumnBasic();
                }
            }
        }();

        // Initialize module
        // ------------------------------

        GoogleColumnBasic.init();
    </script>

<script>
        /* ------------------------------------------------------------------------------
         *
         *  # Google Visualization - columns
         *
         *  Google Visualization column chart demonstration
         *
         * ---------------------------------------------------------------------------- */


        // Setup module
        // ------------------------------

        var GoogleColumnBasic = function () {


            //
            // Setup module components
            //

            // Column chart
            var _googleColumnBasic = function () {
                if (typeof google == 'undefined') {
                    console.warn('Warning - Google Charts library is not loaded.');
                    return;
                }

                // Initialize chart
                google.charts.load('current', {
                    callback: function () {

                        // Draw chart
                        drawColumn();

                        // Resize on sidebar width change
                        var sidebarToggle = document.querySelectorAll('.sidebar-control');
                        if (sidebarToggle) {
                            sidebarToggle.forEach(function (togglers) {
                                togglers.addEventListener('click', drawColumn);
                            });
                        }

                        // Resize on window resize
                        var resizeColumn;
                        window.addEventListener('resize', function () {
                            clearTimeout(resizeColumn);
                            resizeColumn = setTimeout(function () {
                                drawColumn();
                            }, 1);
                        });
                    },
                    packages: ['corechart']
                });

                // Chart settings
                function drawColumn() {

                    // Define charts element
                    var line_chart_element = document.getElementById('google-column-location');
                    // Data
                    var data = google.visualization.arrayToDataTable([
                        ['Count','Location'],
                        <?php foreach(get_all_location() as $transaction) { ?>
                            ['<?=$transaction['city']?>',<?=$transaction['total']?>],
                        <?php } ?>
                    ]);


                    // Options
                    var options_column = {
                        fontName: 'Roboto',
                        height: 400,
                        fontSize: 12,
                        backgroundColor: 'transparent',
                        chartArea: {
                            left: '5%',
                            width: '100%',
                            height: 350
                        },
                        tooltip: {
                            textStyle: {
                                fontName: 'Roboto',
                                fontSize: 13
                            }
                        },
                        vAxis: {
                            title: 'Location',
                            titleTextStyle: {
                                fontSize: 13,
                                italic: false,
                                color: '#333'
                            },
                            textStyle: {
                                color: '#333'
                            },
                            baselineColor: '#ccc',
                            gridlines: {
                                color: '#eee',
                                count: 10
                            },
                            minValue: 0
                        },
                        hAxis: {
                            textStyle: {
                                color: '#333'
                            }
                        },
                        legend: {
                            position: 'top',
                            alignment: 'center',
                            textStyle: {
                                color: '#333'
                            }
                        },
                        series: {
                            0: {
                                color: '#2ec7c9'
                            },
                            1: {
                                color: '#CE614A'
                            },
                            2: {
                                color: '#859DE8'
                            }
                        }
                    };

                    // Draw chart
                    var column = new google.visualization.ColumnChart(line_chart_element);
                    column.draw(data, options_column);
                   
                }
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _googleColumnBasic();
                }
            }
        }();

        // Initialize module
        // ------------------------------

        GoogleColumnBasic.init();
    </script>

    <script>
        /* ------------------------------------------------------------------------------
         *
         *  # Google Visualization - columns
         *
         *  Google Visualization column chart demonstration
         *
         * ---------------------------------------------------------------------------- */


        // Setup module
        // ------------------------------

        var GoogleColumnBasic = function () {


            //
            // Setup module components
            //

            // Column chart
            var _googleColumnBasic = function () {
                if (typeof google == 'undefined') {
                    console.warn('Warning - Google Charts library is not loaded.');
                    return;
                }

                // Initialize chart
                google.charts.load('current', {
                    callback: function () {

                        // Draw chart
                        drawColumn();

                        // Resize on sidebar width change
                        var sidebarToggle = document.querySelectorAll('.sidebar-control');
                        if (sidebarToggle) {
                            sidebarToggle.forEach(function (togglers) {
                                togglers.addEventListener('click', drawColumn);
                            });
                        }

                        // Resize on window resize
                        var resizeColumn;
                        window.addEventListener('resize', function () {
                            clearTimeout(resizeColumn);
                            resizeColumn = setTimeout(function () {
                                drawColumn();
                            }, 1);
                        });
                    },
                    packages: ['corechart']
                });

                // Chart settings
                function drawColumn() {

                    // Define charts element
                    var line_chart_element = document.getElementById('google-column-marital');
                    // Data
                    var data = google.visualization.arrayToDataTable([
                        ['Marital Status', 'Count'],
                        <?php foreach(get_all_maritals() as $transaction) { ?>
                            ['<?=$transaction['marital']?>',<?=count_marital($transaction['marital'])?>],
                        <?php } ?>
                    ]);


                    // Options
                    var options_column = {
                        fontName: 'Roboto',
                        height: 400,
                        fontSize: 12,
                        backgroundColor: 'transparent',
                        chartArea: {
                            left: '5%',
                            width: '100%',
                            height: 350
                        },
                        tooltip: {
                            textStyle: {
                                fontName: 'Roboto',
                                fontSize: 13
                            }
                        },
                        vAxis: {
                            title: 'Marital',
                            titleTextStyle: {
                                fontSize: 13,
                                italic: false,
                                color: '#333'
                            },
                            textStyle: {
                                color: '#333'
                            },
                            baselineColor: '#ccc',
                            gridlines: {
                                color: '#eee',
                                count: 10
                            },
                            minValue: 0
                        },
                        hAxis: {
                            textStyle: {
                                color: '#333'
                            }
                        },
                        legend: {
                            position: 'top',
                            alignment: 'center',
                            textStyle: {
                                color: '#333'
                            }
                        },
                        series: {
                            0: {
                                color: '#2ec7c9'
                            },
                            1: {
                                color: '#CE614A'
                            },
                            2: {
                                color: '#859DE8'
                            }
                        }
                    };

                    // Draw chart
                    var column = new google.visualization.ColumnChart(line_chart_element);
                    column.draw(data, options_column);
                   
                }
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _googleColumnBasic();
                }
            }
        }();

        // Initialize module
        // ------------------------------

        GoogleColumnBasic.init();
    </script>

    <script>
        /* ------------------------------------------------------------------------------
         *
         *  # Google Visualization - columns
         *
         *  Google Visualization column chart demonstration
         *
         * ---------------------------------------------------------------------------- */


        // Setup module
        // ------------------------------

        var GoogleColumnBasic = function () {


            //
            // Setup module components
            //

            // Column chart
            var _googleColumnBasic = function () {
                if (typeof google == 'undefined') {
                    console.warn('Warning - Google Charts library is not loaded.');
                    return;
                }

                // Initialize chart
                google.charts.load('current', {
                    callback: function () {

                        // Draw chart
                        drawColumn();

                        // Resize on sidebar width change
                        var sidebarToggle = document.querySelectorAll('.sidebar-control');
                        if (sidebarToggle) {
                            sidebarToggle.forEach(function (togglers) {
                                togglers.addEventListener('click', drawColumn);
                            });
                        }

                        // Resize on window resize
                        var resizeColumn;
                        window.addEventListener('resize', function () {
                            clearTimeout(resizeColumn);
                            resizeColumn = setTimeout(function () {
                                drawColumn();
                            }, 1);
                        });
                    },
                    packages: ['corechart']
                });

                // Chart settings
                function drawColumn() {

                    // Define charts element
                    var line_chart_element = document.getElementById('google-column-signup');
                    // Data
                    var data = google.visualization.arrayToDataTable([
                        ['Year','Users'],
                        <?php foreach(get_all_users() as $usr) { ?>
                            ['<?=date('M',strtotime($usr['created_at']))?> <?=date('Y',strtotime($usr['created_at']))?>',<?=get_all_signups($usr['month'],$usr['year'])->total?>],
                        <?php } ?>
                    ]);


                    // Options
                    var options_column = {
                        fontName: 'Roboto',
                        height: 400,
                        fontSize: 12,
                        backgroundColor: 'transparent',
                        chartArea: {
                            left: '5%',
                            width: '100%',
                            height: 350
                        },
                        tooltip: {
                            textStyle: {
                                fontName: 'Roboto',
                                fontSize: 13
                            }
                        },
                        vAxis: {
                            title: 'Total User Sign Ups',
                            titleTextStyle: {
                                fontSize: 13,
                                italic: false,
                                color: '#333'
                            },
                            textStyle: {
                                color: '#333'
                            },
                            baselineColor: '#ccc',
                            gridlines: {
                                color: '#eee',
                                count: 10
                            },
                            minValue: 0
                        },
                        hAxis: {
                            textStyle: {
                                color: '#333'
                            }
                        },
                        legend: {
                            position: 'top',
                            alignment: 'center',
                            textStyle: {
                                color: '#333'
                            }
                        },
                        series: {
                            0: {
                                color: '#2ec7c9'
                            }
                        }
                    };

                    // Draw chart
                    var column = new google.visualization.ColumnChart(line_chart_element);
                    column.draw(data, options_column);
                   
                }
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _googleColumnBasic();
                }
            }
        }();

        // Initialize module
        // ------------------------------

        GoogleColumnBasic.init();
    </script>

    <script>
        /* ------------------------------------------------------------------------------
         *
         *  # Google Visualization - columns
         *
         *  Google Visualization column chart demonstration
         *
         * ---------------------------------------------------------------------------- */


        // Setup module
        // ------------------------------

        var GoogleColumnBasic = function () {


            //
            // Setup module components
            //

            // Column chart
            var _googleColumnBasic = function () {
                if (typeof google == 'undefined') {
                    console.warn('Warning - Google Charts library is not loaded.');
                    return;
                }

                // Initialize chart
                google.charts.load('current', {
                    callback: function () {

                        // Draw chart
                        drawColumn();

                        // Resize on sidebar width change
                        var sidebarToggle = document.querySelectorAll('.sidebar-control');
                        if (sidebarToggle) {
                            sidebarToggle.forEach(function (togglers) {
                                togglers.addEventListener('click', drawColumn);
                            });
                        }

                        // Resize on window resize
                        var resizeColumn;
                        window.addEventListener('resize', function () {
                            clearTimeout(resizeColumn);
                            resizeColumn = setTimeout(function () {
                                drawColumn();
                            }, 1);
                        });
                    },
                    packages: ['corechart']
                });

                // Chart settings
                function drawColumn() {

                    // Define charts element
                    var line_chart_element = document.getElementById('google-column-visitors');
                    // Data
                    var data = google.visualization.arrayToDataTable([
                        ['Year','Visitors'],
                        <?php foreach(get_all_visitors() as $visitor) { ?>
                            ['<?=date('M',strtotime($visitor['created_at']))?> <?=date('Y',strtotime($visitor['created_at']))?>',<?=get_visitor_count($visitor['month'],$visitor['year'])->total?>],
                        <?php } ?>
                    ]);


                    // Options
                    var options_column = {
                        fontName: 'Roboto',
                        height: 400,
                        fontSize: 12,
                        backgroundColor: 'transparent',
                        chartArea: {
                            left: '5%',
                            width: '100%',
                            height: 350
                        },
                        tooltip: {
                            textStyle: {
                                fontName: 'Roboto',
                                fontSize: 13
                            }
                        },
                        vAxis: {
                            title: 'Number of Visitors',
                            titleTextStyle: {
                                fontSize: 13,
                                italic: false,
                                color: '#333'
                            },
                            textStyle: {
                                color: '#333'
                            },
                            baselineColor: '#ccc',
                            gridlines: {
                                color: '#eee',
                                count: 10
                            },
                            minValue: 0
                        },
                        hAxis: {
                            textStyle: {
                                color: '#333'
                            }
                        },
                        legend: {
                            position: 'top',
                            alignment: 'center',
                            textStyle: {
                                color: '#333'
                            }
                        },
                        series: {
                            0: {
                                color: '#336699'
                            }
                        }
                    };

                    // Draw chart
                    var column = new google.visualization.ColumnChart(line_chart_element);
                    column.draw(data, options_column);
                   
                }
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _googleColumnBasic();
                }
            }
        }();

        // Initialize module
        // ------------------------------

        GoogleColumnBasic.init();
    </script>


    <script>
                        /* ------------------------------------------------------------------------------
                *
                *  # Google Visualization - lines
                *
                *  Google Visualization line chart demonstration
                *
                * ---------------------------------------------------------------------------- */


                // Setup module
                // ------------------------------

                var GoogleLineBasic = function() {


                //
                // Setup module components
                //

                // Line chart
                var _googleLineBasic = function() {
                    if (typeof google == 'undefined') {
                        console.warn('Warning - Google Charts library is not loaded.');
                        return;
                    }

                    // Initialize chart
                    google.charts.load('current', {
                        callback: function () {

                            // Draw chart
                            drawLineChart();

                            // Resize on sidebar width change
                            var sidebarToggle = document.querySelectorAll('.sidebar-control');
                            if (sidebarToggle) {
                                sidebarToggle.forEach(function(togglers) {
                                    togglers.addEventListener('click', drawLineChart);
                                });
                            }

                            // Resize on window resize
                            var resizeLineBasic;
                            window.addEventListener('resize', function() {
                                clearTimeout(resizeLineBasic);
                                resizeLineBasic = setTimeout(function () {
                                    drawLineChart();
                                }, 1);
                            });
                        },
                        packages: ['corechart']
                    });

                    // Chart settings
                    function drawLineChart() {

                        // Define charts element
                        var line_chart_element = document.getElementById('google-line');

                        // Data
                                var data = google.visualization.arrayToDataTable([
                                    ['Year','Sales'],
                                    <?php foreach(get_all_sales_transaction() as $transaction) { ?>
                                        ['<?=date('M',strtotime($transaction['created_at']))?> <?=date('Y',strtotime($transaction['created_at']))?>',<?=get_sales($transaction['month'],$transaction['year'])->total?>],
                                    <?php } ?>
                                ]);

                                // Options
                                var options = {
                                    fontName: 'Roboto',
                                    height: 400,
                                    fontSize: 12,
                                    chartArea: {
                                        left: '5%',
                                        width: '94%',
                                        height: 350
                                    },
                                    pointSize: 7,
                                    curveType: 'function',
                                    backgroundColor: 'transparent',
                                    tooltip: {
                                        textStyle: {
                                            fontName: 'Roboto',
                                            fontSize: 13
                                        }
                                    },
                                    vAxis: {
                                        title: 'Sales in AED',
                                        titleTextStyle: {
                                            fontSize: 13,
                                            italic: false,
                                            color: '#333'
                                        },
                                        textStyle: {
                                            color: '#333'
                                        },
                                        baselineColor: '#ccc',
                                        gridlines:{
                                            color: '#eee',
                                            count: 10
                                        },
                                        minValue: 0
                                    },
                                    hAxis: {
                                        textStyle: {
                                            color: '#333'
                                        }
                                    },
                                    legend: {
                                        position: 'top',
                                        alignment: 'center',
                                        textStyle: {
                                            color: '#333'
                                        }
                                    },
                                    series: {
                                        0: { color: '#EF5350' }
                                    }
                                };

                                // Draw chart
                                var line_chart = new google.visualization.LineChart(line_chart_element);
                                line_chart.draw(data, options);
                            }
                        };


                        //
                        // Return objects assigned to module
                        //

                        return {
                            init: function() {
                                _googleLineBasic();
                            }
                        }
                        }();


                        // Initialize module
                        // ------------------------------

                        GoogleLineBasic.init();

    </script>

</body>

</html>