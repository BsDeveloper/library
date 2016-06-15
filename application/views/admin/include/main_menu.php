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
                        <a href="<?php echo site_url('login/logout')?>" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
                    </div>
                    <a href="#" class="close">&times;</a>
                </div>
            </div>
            <ul class="navigation">
                <li <?php if($this->uri->segment(2) == 'dashboard') { ?>class="active"<?php } ?>>
                    <a href="<?php echo site_url('admin/dashboard')?>"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-users"></i><span class="mm-text">User</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo site_url('admin/user')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('user'); ?></span></a>
                        </li>

                        <li>
                            <a  tabindex="-1" href="<?php echo site_url('admin/user_admin')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('user admin'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-check-square"></i><span class="mm-text">Kategori</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo site_url('admin/category')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('kategori'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo site_url('admin/category/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah kategori'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-check"></i><span class="mm-text">Sub Kategori</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo site_url('admin/subcategory')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('subkategori'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo site_url('admin/subcategory/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah subkategori'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Post</span></a>
                    <ul>
                        <li class="mm-dropdown">                           
                            <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">List Post</span></a>
                            <ul>
                                <li>
                                    <a  tabindex="-1" href="<?php echo site_url('admin/blog')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('all post'); ?></span></a>
                                </li>

                                <?php $category_list = $this->model_utama->get_order('category_title','asc','category'); ?>
                                <?php if($category_list->num_rows() > 0) : ?>
                                    <?php foreach($category_list->result() as $row) : ?>
                                        <li>
                                            <a  tabindex="-1" href="<?php echo site_url('admin/blog/category/'.$row->category_id)?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords($row->category_title); ?></span></a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo site_url('admin/blog/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah post'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-archive"></i><span class="mm-text">Halaman</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo site_url('admin/page')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('halaman'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo site_url('admin/page/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah halaman'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>

                <!-- <li>
                    <a href="<?php echo site_url('admin/ticker')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text">Ticker</span></a>
                </li> -->



                

                <!-- <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Berita</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo site_url('admin/berita')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('berita'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo site_url('admin/berita/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah berita'); ?></span></a>
                        </li>
                        
                    </ul>
                </li> -->

               <!--  
                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-home"></i><span class="mm-text">Kelola Halaman Home</span></a>
                    <ul>
                        <li class="mm-dropdown">
                            <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Slider</span></a>
                            <ul>
                                <li>
                                    <a  tabindex="-1" href="<?php echo site_url('admin/slider')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('slider'); ?></span></a>
                                </li>

                                <li>
                                    <a tabindex="-1" href="<?php echo site_url('admin/slider/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah slider'); ?></span></a>
                                </li>
                                
                            </ul>
                        </li>

                        <li class="mm-dropdown">
                            <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Banner</span></a>
                            <ul>
                                <li>
                                    <a  tabindex="-1" href="<?php echo site_url('admin/banner')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('banner'); ?></span></a>
                                </li>

                                <li>
                                    <a tabindex="-1" href="<?php echo site_url('admin/banner/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah banner'); ?></span></a>
                                </li>
                                
                            </ul>
                        </li>

                        <li class="mm-dropdown">
                            <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Klien</span></a>
                            <ul>
                                <li>
                                    <a  tabindex="-1" href="<?php echo site_url('admin/klien')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('klien'); ?></span></a>
                                </li>

                                <li>
                                    <a tabindex="-1" href="<?php echo site_url('admin/klien/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah klien'); ?></span></a>
                                </li>
                                
                            </ul>
                        </li>

                        <li class="mm-dropdown">
                            <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Liputan</span></a>
                            <ul>
                                <li>
                                    <a  tabindex="-1" href="<?php echo site_url('admin/liputan')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('liputan'); ?></span></a>
                                </li>

                                <li>
                                    <a tabindex="-1" href="<?php echo site_url('admin/liputan/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah liputan'); ?></span></a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="mm-dropdown">
                            <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Testimonial</span></a>
                            <ul>
                                <li>
                                    <a  tabindex="-1" href="<?php echo site_url('admin/testimonial')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('testimonial'); ?></span></a>
                                </li>

                                <li>
                                    <a tabindex="-1" href="<?php echo site_url('admin/testimonial/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah testimonial'); ?></span></a>
                                </li>
                                
                            </ul>
                        </li>

                        <li class="mm-dropdown">
                            <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Karya</span></a>
                            <ul>
                                <li>
                                    <a  tabindex="-1" href="<?php echo site_url('admin/karya')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('karya'); ?></span></a>
                                </li>

                                <li>
                                    <a tabindex="-1" href="<?php echo site_url('admin/karya/add')?>"><i class="menu-icon fa fa-plus"></i><span class="mm-text"><?php echo ucwords('tambah karya'); ?></span></a>
                                </li>
                                
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="mm-dropdown">
                    <a href="#"><i class="menu-icon fa fa-archive"></i><span class="mm-text">Kursus</span></a>
                    <ul>
                        <li>
                            <a  tabindex="-1" href="<?php echo site_url('admin/fitur')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('fitur'); ?></span></a>
                        </li>

                        <li>
                            <a tabindex="-1" href="<?php echo site_url('admin/kursus')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('kursus'); ?></span></a>
                        </li>
                        
                    </ul>
                </li>
                

                <li>
                    <a href="<?php echo site_url('admin/menu')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text">Menu</span></a>
                </li> -->

                

                <li class="mm-dropdown">

                    <a href="#"><i class="menu-icon fa fa-picture-o"></i><span class="mm-text">Galeri</span></a>

                    <ul>



                        <li <?php if($this->uri->segment(2) == 'galeri_category') { ?>class="active"<?php } ?>>

                            <a tabindex="-1"  href="<?php echo site_url('admin/galeri_category')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('galeri category'); ?></span></a>

                        </li>



                        <li <?php if($this->uri->segment(2) == 'galeri') { ?>class="active"<?php } ?>>

                            <a tabindex="-1"  href="<?php echo site_url('admin/galeri')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('galeri'); ?></span></a>

                        </li>

                    </ul>

                </li>



                <li class="mm-dropdown">

                    <a href="#"><i class="menu-icon fa fa-youtube-play"></i><span class="mm-text">Video</span></a>

                    <ul>

                        <li <?php if($this->uri->segment(2) == 'video_category') { ?>class="active"<?php } ?>>

                            <a href="<?php echo site_url('admin/video_category')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('video category'); ?></span></a>

                        </li>



                        <li <?php if($this->uri->segment(2) == 'video') { ?>class="active"<?php } ?>>

                            <a href="<?php echo site_url('admin/video')?>"><i class="menu-icon fa fa-file"></i><span class="mm-text"><?php echo ucwords('video'); ?></span></a>

                        </li>

                    </ul>

                </li>
                <li>

                    <a href="<?php echo site_url('admin/trial')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('Daftar Peserta Trial'); ?></span></a>

                </li>
                <li>

                    <a href="<?php echo site_url('admin/dashboard/bonus_voucher')?>"><i class="menu-icon fa fa-list"></i><span class="mm-text"><?php echo ucwords('Daftar Penerima Bonus'); ?></span></a>

                </li>
            </ul> <!-- / .navigation -->
            <div class="menu-content">
                <a href="#" class="btn btn-primary btn-block btn-outline dark">Develop By Babastudio</a>
            </div>
        </div> <!-- / #main-menu-inner -->
    </div> <!-- / #main-menu -->