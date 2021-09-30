<!-- Body Content Start -->
<div class="container p-3 mb-5">
    <div class="row mb-2">
        <div class="col-md-10">
            <h3><i class="fas fa-home"></i> Dashboard</h3>
        </div>
    </div>
    <div class="row ">
        <div class="col-12 shadow-sm bg-white rounded-lg">
            <div class="row p-3 ">
                <div class="col-lg-4 col-md-6 col-sm-6 text-white mr-auto ml-auto">
                    <div class="row border bg-light-green shadow-sm p-3">
                        <div class="col-lg-3 col-md-12 col-md-12 text-center">
                            <i class="fas fa-user-graduate fa-4x opacity-80"></i>
                        </div>
                        <div class="col-lg-8 mt-auto mb-auto text-center">
                            <span style="font-size: 1.2em">Total Students: </span>
                            <br>
                            <span style="font-size: 1.2em">
                                <?=$totalStudents?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 text-white mr-auto ml-auto">
                    <div class="row border bg-light-blue shadow-sm p-3">
                        <div class="col-lg-3 col-md-12 col-md-12 text-center">
                            <i class="fas fa-chalkboard fa-4x opacity-80"></i>
                        </div>
                        <div class="col-lg-8 mt-auto mb-auto text-center">
                            <span style="font-size: 1.2em">Total Classes: </span>
                            <br>
                            <span style="font-size: 1.2em">
                                <?=$totalClasses;?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 text-white mr-auto ml-auto">
                    <div class="row border bg-light-brown shadow-sm p-3">
                        <div class="col-lg-3 col-md-12 col-md-12 text-center">
                            <i class="fas fa-sitemap fa-4x opacity-80"></i>
                        </div>
                        <div class="col-lg-8 mt-auto mb-auto text-center">
                            <span style="font-size: 1.2em">Total Sections: </span>
                            <br>
                            <span style="font-size: 1.2em">
                                <?=$totalSections?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br />
    <div class="row mb-2 bg-white shadow-sm rounded p-2">
        <div class="col-12 p-2 text-center">
            <h4 class="my-2">Classwise Student Data</h4>
            <div id="bar-chart" class="w-100" style="height: 300px;"></div>
        </div>
    </div>
</div>
<!-- Body Content End -->

<script type="text/javascript">

    /* BAR CHART * ---------*/
    var bar_data = {
        data : [
            <?php foreach($graph as $graphValue) {?>
            [<?=$graphValue->classIdFK?>,<?=$graphValue->totalStudents?>],
            <?php } ?>
        ],
        bars: { show: true }
    };
    $.plot('#bar-chart', [bar_data], {
        grid  : {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor  : '#f3f3f3'
        },
        series: {
            bars: {
                show: true, barWidth: 0.5, align: 'center',
            },
        },
        colors: ['#3c8dbc'],
        xaxis : {
            show : true,
            axisLabel : 'Classes',
            ticks: [
                <?php foreach($graph as $graphValue) {?>
                [<?=$graphValue->classIdFK?>,'<?=$graphValue->className?>'],
                <?php } ?>
            ]
        },
        yaxis: {
            show : true,
            axisLabel : 'No. of Students',
            position: 'left',
            //show: true,
            /*tickSize: 100,*/
            minTickSize: 1,
            tickDecimals: 0
        }

    });
    /* END BAR CHART */
</script>