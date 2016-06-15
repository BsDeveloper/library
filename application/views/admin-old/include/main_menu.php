<?php
    $user_id                = $this->session->userdata('id_user');
    $user                   = $this->db->query("select * from user where user.user_id = '$user_id'")->row();
?>

<div id="main-menu" role="navigation">
        <div id="main-menu-inner">
            <div class="menu-content top" id="menu-content-demo">
                <!-- Menu custom content demo
                     CSS:        styles/pixel-admin-less/demo.less or styles/pixel-admin-scss/_demo.scss
                     Javascript: html/<?php echo base_url()?>assets/demo/demo.js
                 -->
                <div>
                    <div class="text-bg"><span class="text-semibold"><?php echo character_limiter(set_value('user_picture', isset($user->user_name) ? ucwords($user->user_name) : 'Weleh'),10); ?></span></div>

                    <img width="150" src="<?php echo base_url()?>uploads/user/<?php echo set_value('user_picture', isset($user->user_detail_picture) ? ucwords($user->user_detail_picture) : 'default.jpg'); ?>" class="img img-responsive">
                    <div class="btn-group">
                        <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
                        <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
                        <a href="<?php echo base_url()?>login/logout" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
                    </div>
                    <a href="#" class="close">&times;</a>
                </div>
            </div>
            <ul class="navigation">
                <li <?php if($this->uri->segment(2) == 'dashboard') { ?>class="active"<?php } ?>>
                    <a href="<?php echo base_url()?>admin/dashboard"><i class="menu-icon fa fa-home"></i><span class="mm-text">Beranda</span></a>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-check-square"></i><span class="mm-text">Kategori</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo base_url()?>admin/category"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('kategori'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo base_url()?>admin/category/add"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah kategori'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-check"></i><span class="mm-text">Sub Kategori</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo base_url()?>admin/subcategory"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('subkategori'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo base_url()?>admin/subcategory/add"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah subkategori'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Blog</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo base_url()?>admin/blog"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('blog'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo base_url()?>admin/blog/add"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah blog'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-archive"></i><span class="mm-text">Halaman</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo base_url()?>admin/page"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('halaman'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo base_url()?>admin/page/add"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah halaman'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Slider</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo base_url()?>admin/slider"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('slider'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo base_url()?>admin/slider/add"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah slider'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

            </ul> <!-- / .navigation -->
            <div class="menu-content">
                <a href="#" class="btn btn-primary btn-block btn-outline dark">Develop By Babastudio</a>
            </div>
        </div> <!-- / #main-menu-inner -->
    </div> <!-- / #main-menu -->