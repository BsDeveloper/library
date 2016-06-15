<?php
    $user_id                = $this->session->userdata('id_user');
    $user                   = $this->db->query("select * from user where user.user_id = '$user_id'")->row();
?>
<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
        <!-- Main menu toggle -->
        <button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
        
        <div class="navbar-inner">
            <!-- Main navbar header -->
            <div class="navbar-header">

                <!-- Logo -->
                <a href="<?php echo base_url()?>admin" class="navbar-brand">
                    <!-- <div><img alt="" src="<?php echo base_url()?>assets/images/"></div> -->
                    Admin
                </a>

                <!-- Main navbar toggle -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

            </div> <!-- / .navbar-header -->

            <div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
                <div>
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?php echo base_url()?>admin">Beranda</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>" target="_blank">View Website</a>
                        </li>
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu</a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url()?>admin/users">Juri</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url()?>admin/category">Kategori</a></li>
                                <li><a href="<?php echo base_url()?>admin/criteria">Kriteria</a></li>
                            </ul>
                        </li> -->
                    </ul> <!-- / .navbar-nav -->

                    <div class="right clearfix">
                        <ul class="nav navbar-nav pull-right right-navbar-nav">
                            <li>
                                <form class="navbar-form pull-left" action="<?php echo base_url()?>admin/product/search" method="post">
                                    <input type="text" class="form-control" placeholder="Search" name="q">
                                </form>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
                                    <img width="150" src="<?php echo base_url()?>uploads/user/<?php echo set_value('user_picture', isset($user->user_detail_picture) ? ucwords($user->user_detail_picture) : 'default.jpg'); ?>" class="img img-responsive">
                                    <span><?php echo (set_value('user_picture', isset($user->user_name) ? ucwords($user->user_name) : 'Weleh')); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="dropdown-icon fa fa-user"></i>&nbsp;&nbsp;Account</a></li>
                                    <li><a href="#"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo base_url()?>login/logout"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
                                </ul>
                            </li>
                        </ul> <!-- / .navbar-nav -->
                    </div> <!-- / .right -->
                </div>
            </div> <!-- / #main-navbar-collapse -->
        </div> <!-- / .navbar-inner -->
    </div> <!-- / #main-navbar -->