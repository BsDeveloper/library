<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] 				= 'login';
$route['p']						= 'page';
$route['^p/:any'] 				= 'page/index';

$route['register'] 				= 'login/register_form';

// $route['blog']					= 'blog/index';
// $route['^blog/:any'] 			= 'blog/index';

$route['^video/:any'] 			= 'video/index';
$route['^vid/:any'] 			= 'vid/index';
$route['^galeri/:any'] 			= 'galeri/index';

// $route['berita']				= 'berita';
$route['kursus'] 				= "kursus";
// $route['blog'] 					= "blog";
$route['dashboard'] 			= "dashboard";
$route['category'] 				= "category";
$route['galeri'] 				= "galeri";
$route['home'] 					= "home";
$route['login'] 				= "login";
$route['page'] 					= "page";
$route['video'] 				= "video";
$route['kontak'] 				= "kontak";
$route['feed'] 					= "feed";
$route['post'] 					= "post";

// $route['berita/(:any)'] 		= "berita/$1";
$route['kursus/(:any)'] 		= "kursus/$1";
// $route['blog/(:any)'] 			= "blog/$1";
$route['category/(:any)'] 		= "category/$1";
$route['galeri/(:any)'] 		= "galeri/$1";
$route['home/(:any)'] 			= "home/$1";
$route['login/(:any)'] 			= "login/$1";
$route['page/(:any)'] 			= "page/$1";
$route['video/(:any)'] 			= "video/$1";
$route['kontak/(:any)'] 		= "kontak/$1";
$route['feed/(:any)'] 			= "feed/$1";
$route['post/(:any)'] 			= "post/$1";

$route['admin/banner'] 			= "admin/banner";
$route['admin/berita'] 			= "admin/berita";
$route['admin/blog'] 			= "admin/blog";
$route['admin/category'] 		= "admin/category";
$route['admin/dashboard'] 		= "admin/dashboard";
$route['admin/fitur'] 			= "admin/fitur";
$route['admin/galeri'] 			= "admin/galeri";
$route['admin/galeri_category'] = "admin/galeri_category";
$route['admin/karya'] 			= "admin/karya";
// $route['admin/klien'] 			= "admin/klien";
$route['admin/kursus'] 			= "admin/kursus";
$route['admin/liputan'] 		= "admin/liputan";
$route['admin/menu'] 			= "admin/menu";
$route['admin/page'] 			= "admin/page";
$route['admin/slider'] 			= "admin/slider";
$route['admin/subcategory'] 	= "admin/subcategory";
$route['admin/testimonial'] 	= "admin/testimonial";
$route['admin/ticker'] 			= "admin/ticker";
$route['admin/user'] 			= "admin/user";
$route['admin/user_admin'] 		= "admin/user_admin";
$route['admin/video'] 			= "admin/video";
$route['admin/video_category'] 	= "admin/video_category";
$route['admin/kursus'] 			= "admin/kursus";
$route['admin/message'] 		= "admin/message";
$route['admin/trial'] 			= "admin/trial";

$route['admin/banner/(:any)'] 			= "admin/banner/$1";
$route['admin/berita/(:any)'] 			= "admin/berita/$1";
$route['admin/blog/(:any)'] 			= "admin/blog/$1";
$route['admin/category/(:any)'] 		= "admin/category/$1";
$route['admin/fitur/(:any)'] 			= "admin/fitur/$1";
$route['admin/dashboard/(:any)'] 		= "admin/dashboard/$1";
$route['admin/galeri/(:any)'] 			= "admin/galeri/$1";
$route['admin/galeri_category/(:any)'] 	= "admin/galeri_category/$1";
$route['admin/karya/(:any)'] 			= "admin/karya/$1";
$route['admin/klien/(:any)'] 			= "admin/klien/$1";
$route['admin/kursus/(:any)'] 			= "admin/kursus/$1";
$route['admin/liputan/(:any)'] 			= "admin/liputan/$1";
$route['admin/menu/(:any)'] 			= "admin/menu/$1";
$route['admin/page/(:any)'] 			= "admin/page/$1";
$route['admin/slider/(:any)'] 			= "admin/slider/$1";
$route['admin/subcategory/(:any)'] 		= "admin/subcategory/$1";
$route['admin/testimonial/(:any)'] 		= "admin/testimonial/$1";
$route['admin/ticker/(:any)'] 			= "admin/ticker/$1";
$route['admin/user/(:any)'] 			= "admin/user/$1";
$route['admin/user_admin/(:any)'] 		= "admin/user_admin/$1";
$route['admin/video/(:any)'] 			= "admin/video/$1";
$route['admin/video_category/(:any)'] 	= "admin/video_category/$1";
$route['admin/kursus/(:any)'] 			= "admin/kursus/$1";
$route['admin/message/(:any)'] 			= "admin/message/$1";
$route['admin/trial/(:any)'] 			= "admin/trial/$1";


$route['training/belajar_membuat_website']		= 'page/index/paket-kursus-web-profesional-untuk-anda';
$route['training/belajar-membuat-website']		= 'page/index/paket-kursus-web-profesional-untuk-anda';
$route['training/belajar_membuat_animasi']		= 'page/index/kursus-flash-animasi';
$route['training/belajar-membuat-animasi']		= 'page/index/kursus-flash-animasi';
$route['training/kursus-web-design']			= 'page/index/kursus-web-design';
$route['training/kursus-website']				= 'page/index/kursus-website';
$route['training/kursus-php']					= 'page/index/kursus-php';
$route['training/kursus-internet-marketing']	= 'page/index/kursus-internet-marketing';
$route['training/gallery-photo']				= 'galeri';
$route['about/client']							= 'page/index/klien';
$route['training/belajar_internet_marketing']	= 'page/index/kursus-internet-marketing';
$route['news/detail/254']						= 'page/index/alumni-webmaster-babastudio-memenangkan-kontes-website-rp-100-juta';
$route['training/program/actionscript-3.0']		= 'page/index/actionscript-30';
$route['video/tutorial/category/2']				= 'category/index/video-tutorial';
$route['video/tutorial/detail/26']				= 'post/index/mudahnya-membuat-animasi-hitungan-angka';
$route['free_course']							= 'home/free_course';
$route['save']									= 'home/save';
$route['save_bbm']								= 'home/save_bbm';
$route['save_finish']							= 'home/save_finish';
$route['isi_modal']								= 'home/isi_modal';
$route['training/karya_murid']					= 'page/category/karya-murid';

$route['(:any)'] 						= 'page/detail';
$route['(:any)/(:any)']					= 'page/detail';
$route['(:any)/(:any)/(:any)']			= 'page/detail';
// $route['(:any)/(:any)/(:any)/(:any)']	= 'page/detail';
