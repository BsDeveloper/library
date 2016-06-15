<div id="content-wrapper">
        <ul class="breadcrumb breadcrumb-page">
            <div class="breadcrumb-label text-light-gray">You are here: </div>
            <li><a href="#">Home</a></li>
            <li class="active"><a href="#">Dashboard</a></li>
        </ul>
        <div class="page-header">
            
            <div class="row">
                <!-- Page header, center on small screens -->
                <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;Dashboard</h1>


                <div class="col-xs-12 col-sm-8">
                    <div class="row">
                        <hr class="visible-xs no-grid-gutter-h">
                        <!-- "Create project" button, width=auto on desktops -->
                        <!-- <div class="pull-right col-xs-12 col-sm-auto"><a href="#" class="btn btn-primary btn-labeled" style="width: 100%;"><span class="btn-label icon fa fa-plus"></span>Create project</a></div> -->

                        <!-- Margin -->
                        <!-- <div class="visible-xs clearfix form-group-margin"></div> -->

                        <!-- Search field -->
                        <!-- <form action="#" class="pull-right col-xs-12 col-sm-6"> -->
                            <!-- <div class="input-group no-margin"> -->
                                <!-- <span class="input-group-addon" style="border:none;background: #fff;background: rgba(0,0,0,.05);"><i class="fa fa-search"></i></span> -->
                                <!-- <input type="text" placeholder="Search..." class="form-control no-padding-hr" style="border:none;background: #fff;background: rgba(0,0,0,.05);"> -->
                            <!-- </div> -->
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div> <!-- / .page-header -->


        <div class="row">
            <div class="col-md-12">

<!-- 5. $UPLOADS_CHART =============================================================================

                Uploads chart
-->
                <!-- Javascript -->
                <script>
                    init.push(function () {
                        var uploads_data = [
                            <?php if($visitor_list->num_rows() > 0) : ?>
                            <?php foreach($visitor_list->result() as $row) : ?>
                            { day: '<?php echo date("Y-m-d",strtotime($row->create_date))?>', v: <?php echo $row->total?> },
                            <?php endforeach; ?>
                            <?php endif; ?>
                        ];
                        Morris.Line({
                            element: 'hero-graph',
                            data: uploads_data,
                            xkey: 'day',
                            ykeys: ['v'],
                            labels: ['Value'],
                            lineColors: ['#fff'],
                            lineWidth: 2,
                            pointSize: 4,
                            gridLineColor: 'rgba(255,255,255,.5)',
                            resize: true,
                            gridTextColor: '#fff',
                            xLabels: "day",
                            xLabelFormat: function(d) {
                                return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov', 'Dec'][d.getMonth()] + ' ' + d.getDate(); 
                            },
                        });
                    });
                </script>
                <!-- / Javascript -->

                <div class="stat-panel">
                    <div class="stat-row">
                        
                        <!-- Primary background, small padding, vertically centered text -->
                        <div class="stat-cell col-sm-12 bg-primary padding-sm valign-middle">
                            <div id="hero-graph" class="graph" style="height: 253px;"></div>
                        </div>
                    </div>
                </div> <!-- /.stat-panel -->
<!-- /5. $UPLOADS_CHART -->


            </div>

        </div>

    

        <!-- Page wide horizontal line -->
        <hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

        <div class="row">

<!-- 12. $NEW_USERS_TABLE ==========================================================================

            New users table
-->
            <div class="col-md-12">
                <div class="panel panel-dark panel-light-green">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="panel-title-icon fa fa-smile-o"></i>10 New users</span>
                        <div class="panel-heading-controls">
                            <!-- <ul class="pagination pagination-xs">
                                <li><a href="#">«</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">»</a></li>
                            </ul> --> <!-- / .pagination -->
                        </div> <!-- / .panel-heading-controls -->
                    </div> <!-- / .panel-heading -->
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="valign-middle">
                            <?php if($new_user_list->num_rows() > 0 ) : $i=1; ?>
                                <?php foreach($new_user_list->result() as $row) : ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo ucwords($row->user_name)?></td>
                                    <td><?php echo $row->username ?></td>
                                    <td><?php echo ucwords($row->user_status) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4"><center>Data tidak Ada</center></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    
                </div> <!-- / .panel -->
            </div>
<!-- /12. $NEW_USERS_TABLE -->


        </div>
    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
    <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url()?>assets/javascripts/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url()?>assets/javascripts/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
    init.push(function () {
        // Javascript code here
    })
    window.PixelAdmin.start(init);
</script>