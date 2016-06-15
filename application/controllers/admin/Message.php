<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Message extends MY_Controller {

	
	public function index() {

	}

	function send()
	{
		$from = 'info@babastudio.com';
		$subject = 'Undangan Kontes SEO Babastudio 2016.';
		

		// $cek_penerima = $this->model_utama->get_order_limit('kontes_user_id','asc',1,'kontes_user');
		$cek_penerima = $this->model_utama->get_data('kontes_user');
		if($cek_penerima->num_rows() > 0)
		{

			foreach($cek_penerima->result() as $row) {

				$recipient = $row->kontes_user_email;
				$message = '
					Hi '.$row->kontes_user_nama.'<br>
					tahun lalu kamu pernah mendaftar sebagai peserta kontes SEO sekolahpintar.<br>
					<br>
					Kali ini Babastudio yang akan mengundang kamu, karena kami sudah pelajari, keahlian '.$row->kontes_user_nama.' di bidang SEO sudah tidak diragukan lagi.<br>
					Hadiah uang tunai 5 juta menanti Kamu.<br>
					<br>
					Silahkan Daftar di Link ini http://www.babastudio.com/kontes-seo/<br>
					<br>
					Selamat Mendaftar<br>
					<br>
					Salam SEO<br>
					<br>
					babastudio
				';

				if($this->send_email($from,$recipient,$subject,$message))
				{
					echo $recipient.' : sukses<br>';
				}
				else
				{
					echo $recipient.' : gagal<br>'
				}

			}
		}

		
	}


	function email_followup()
	{
		$cek_penerima = $this->model_utama->cek_data('no','send_all_email','popup_trial');
		$title 		= '';
		$content 	= '';
		$from = 'info@babastudio.com';

		if($cek_penerima->num_rows() > 0)
		{
			foreach($cek_penerima->result() as $row) 
			{
				if($row->materi == 'Website') $materi = 'website';
				elseif($row->materi == 'Animasi') $materi = 'animasi';
				elseif($row->materi == 'Internet Marketing') $materi = 'internet_marketing';
				elseif($row->materi == 'SEO') $materi = 'seo';
				elseif($row->materi == 'Kursus Komputer') $materi = 'kursus_komputer';

				$recipient = $row->email;

				$cek_send_email = $this->model_utama->cek_data($row->popup_trial_id,'popup_trial_id','popup_trial_email');
				if($cek_send_email->num_rows() == 0) $send_after = 'first';
				if($cek_send_email->num_rows() == 1) $send_after = 'second';
				if($cek_send_email->num_rows() == 2) $send_after = 'third';

				if($materi == 'website')
				{
					if($send_after == 'first')
					{
						$title 		= $row->nama.' ini 6 trend Web Design terbaru tahun 2016 untuk kamu';
						$content 	= 'Hi '.$row->nama.', <br>
							Kita perlu tau trend terbaru dalam web design biar ga ketinggalan.<br>
							Ada yang namya Micro Design, FLat Design dan lain-lain. <br>
							Untuk lebih jelas silahkan Klik Link berikut ini.<br>
							http://www.babastudio.com/blog/trend-website-menggunakan-video-sebagai-background<br>
							http://www.babastudio.com/blog/trend-web-20<br>
							<br>	
							Salam Web Master
						';
						$kode_marketing = 1;
					}
					elseif($send_after == 'second')
					{
						$title 		= 'Sebenarnya Berapa sih harga sebuah website?';
						$content 	= $row->nama.' setuju ga?<br>
							Andai kita tau berapa sebenarya harga sebuah website,<br>
							kita ga akan salah beli ataupun salah jual<br>
							Babastudio ingin memberikan bocoran mengenai hal Ini.<br>
							Silahkan kamu lihat berapa sih sebenarnya harga sebuah website<br>
							klik http://www.babastudio.com/cara-membuat-website<br>
							<br>
							Salam Web Master
						';
						$kode_marketing = 2;
					}
					elseif($send_after == 'third')
					{
						$title 		= 'Lowongan Kerja & Peluang Bisnis seorang Web Master ';
						$content 	= '
							Apa yang bisa '.$row->nama.' dapatkan ketika nanti sudha menguasai keahlian WebMaster?<br>
							Baik lowongan Kerja  maupun Peluang Bisnisnya.<br>
							Silahkan pelajari di sini<br>
							http://www.babastudio.com/blog/peluang-bisnis-online<br>
							<br>
							Salam web master
						';
						$kode_marketing = 3;
					}					
				}
				elseif($materi == 'animasi')
				{
					if($send_after == 'first')
					{
						$title 		= $row->nama.', ini dia TREND animasi terbaru di tahun2016';
						$content 	= '
							Hi '.$row->nama.' <br>
							Kita perlu tau trend terbaru dalam film Animasi, biar ga<br>
							ketinggalan. Untuk itu, silahkan baca <br>
							apa saja sih TREND animasi terbaru di tahun 2016 <br>
							dengan klik Link ini <br>
							http://www.babastudio.com/blog/mudahnya-membuat-animasi-hitungan-angka<br>
							<br>
							Salam Animasi
						';
						$kode_marketing = 4;
					}
					elseif($send_after == 'second')
					{
						$title 		= '10 Film dengan teknik Animasi terhebat sepanjang Masa';
						$content 	= '
							Hi '.$row->nama.' <br>
							Kira-kira kamu bisa tebak ga, film-film animasi terhebat sepanjang masa,
							coba lihat di sini
							http://www.babastudio.com/cara-membuat-website<br>
							<br>
							Salam Animasi
						';
						$kode_marketing = 5;						
					}
					elseif($send_after == 'third')
					{
						$title 		= '5 Website dengan animasi Terhebat di 2016';
						$content 	= '
							'.$row->nama.', penggunaan animasi memang akan membuat <br>
							website lebih menarik. Dan 5 Website ini menggunakan<br>
							animasi yang luar biasa, sekaligus tidak berat untuk dibuka.<br>
							Silahkan menikmati dengan Klik link berikut ini<br>
							http://www.babastudio.com/cara-membuat-website<br>
							<br>
							Salam Animasi
						';
						$kode_marketing = 6;
					}
				}
				elseif($materi == 'internet_marketing')
				{
					if($send_after == 'first')
					{
						$title 		= 'Ini dia Teknik Internet Marketing yg Bikin 4000 toko Online Super Laku!';
						$content 	= '
							Apa kira-kira teknik, yang membuat 4000 toko online<br>
							di seluruh belahan dunia ini Laku banget jualannya.<br>
							<br>
							Simak pengakuan ribuan pemilik toko online besar di<br>
							berbagai Belahan dunia, mengenai teknik Internet Marketing mereka<br>
							disini : http://www.babastudio.com/blog/strategi-serangan-internet-marketing<br>
							<br>
							Salam Internet Marketing
						';
						$kode_marketing = 7;
					}
					elseif($send_after == 'second')
					{
						$title 		= 'Kesalahan yang paling sering dilakukan Para Internet Marketer';
						$content 	= '
							Hi '.$row->nama.' <br>
							Tanpa sadar, banyak para Internet Marketer yang sudah<br>
							tau mengenai SEO, SEM ataupun SMM. Bahkan sampai<br>
							taraf ahli, tetap juga melakukan kesalahan yg sama.<br>
							<br>
							Akibatnya, website yang mereka optimasi, memang ramai<br>
							pengunjung TAPI -------> SEPI pembeli.<br>
							Agar kita pahami, bahwa sebuah website bisa saja ramai,<br>
							Tapi tetap sepi pembeli.<br>
							<br>
							Simak kesalahan mereka di sini :
							disini : http://www.babastudio.com/blog/internet-marketing-spam<br>
							<br>
							Salam Internet Marketing
						';
						$kode_marketing = 8;
					}
					elseif($send_after == 'third')
					{
						$title 		= 'Peluang Kerja dan Bisnis bagi para Ahli Internet marketing';
						$content 	= '
							Apa saja peluang Kerja dan Bisnis yang bisa '.$row->nama.' <br>
							dapatkan ketika telah menguasai Teknik internet Marketing?<br>
							<br>
							Temukan peluang-peluang tersebut yang saat ini<br>
							dinikmati segelintir orang ahli Internet marketing.<br>
							<br>
							Cari tau dengan Klik link berikut ini.<br>
							http://www.babastudio.com/blog/internet-marketing-spam<br>
							<br>
							Salam Internet Marketing
						';
						$kode_marketing = 8;
					}
				}
				elseif($materi == 'seo')
				{
					if($send_after == 'first')
					{
						$title 		= 'Ini dia Teknik Internet Marketing yg Bikin 4000 toko Online Super Laku!';
						$content 	= '
							Apa kira-kira teknik, yang membuat 4000 toko online<br>
							di seluruh belahan dunia ini Laku banget jualannya.<br>
							<br>
							Simak pengakuan ribuan pemilik toko online besar di<br>
							berbagai Belahan dunia, mengenai teknik Internet Marketing mereka<br>
							disini : http://www.babastudio.com/blog/strategi-serangan-internet-marketing<br>
							<br>
							Salam Internet Marketing
						';
						$kode_marketing = 10;
					}
					elseif($send_after == 'second')
					{
						$title 		= 'Kesalahan yang paling sering dilakukan Para Internet Marketer';
						$content 	= '
							Hi '.$row->nama.' <br>
							Tanpa sadar, banyak para Internet Marketer yang sudah<br>
							tau mengenai SEO, SEM ataupun SMM. Bahkan sampai<br>
							taraf ahli, tetap juga melakukan kesalahan yg sama.<br>
							<br>
							Akibatnya, website yang mereka optimasi, memang ramai<br>
							pengunjung TAPI -------> SEPI pembeli.<br>
							Agar kita pahami, bahwa sebuah website bisa saja ramai,<br>
							Tapi tetap sepi pembeli.<br>
							<br>
							Simak kesalahan mereka di sini :
							disini : http://www.babastudio.com/blog/internet-marketing-spam<br>
							<br>
							Salam Internet Marketing
						';
						$kode_marketing = 11;
					}
					elseif($send_after == 'third')
					{
						$title 		= 'Peluang Kerja dan Bisnis bagi para Ahli Internet marketing';
						$content 	= '
							Apa saja peluang Kerja dan Bisnis yang bisa '.$row->nama.' <br>
							dapatkan ketika telah menguasai Teknik internet Marketing?<br>
							<br>
							Temukan peluang-peluang tersebut yang saat ini<br>
							dinikmati segelintir orang ahli Internet marketing.<br>
							<br>
							Cari tau dengan Klik link berikut ini.<br>
							http://www.babastudio.com/blog/internet-marketing-spam<br>
							<br>
							Salam Internet Marketing
						';
						$kode_marketing = 12;
					}
				}
				elseif($materi == 'kursus_komputer')
				{
					if($send_after == 'first')
					{
						$title 		= $row->nama.' ini 6 trend Web Design terbaru tahun 2016 untuk kamu';
						$content 	= 'Hi '.$row->nama.', <br>
							Kita perlu tau trend terbaru dalam web design biar ga ketinggalan.<br>
							Ada yang namya Micro Design, FLat Design dan lain-lain. <br>
							Untuk lebih jelas silahkan Klik Link berikut ini.<br>
							http://www.babastudio.com/blog/trend-website-menggunakan-video-sebagai-background<br>
							http://www.babastudio.com/blog/trend-web-20<br>
							<br>	
							Salam Web Master
						';
						$kode_marketing = 13;
					}
					elseif($send_after == 'second')
					{
						$title 		= 'Sebenarnya Berapa sih harga sebuah website?';
						$content 	= $row->nama.' setuju ga?<br>
							Andai kita tau berapa sebenarya harga sebuah website,<br>
							kita ga akan salah beli ataupun salah jual<br>
							Babastudio ingin memberikan bocoran mengenai hal Ini.<br>
							Silahkan kamu lihat berapa sih sebenarnya harga sebuah website<br>
							klik http://www.babastudio.com/cara-membuat-website<br>
							<br>
							Salam Web Master
						';
						$kode_marketing = 14;
					}
					elseif($send_after == 'third')
					{
						$title 		= 'Lowongan Kerja & Peluang Bisnis seorang Web Master ';
						$content 	= '
							Apa yang bisa '.$row->nama.' dapatkan ketika nanti sudha menguasai keahlian WebMaster?<br>
							Baik lowongan Kerja  maupun Peluang Bisnisnya.<br>
							Silahkan pelajari di sini<br>
							http://www.babastudio.com/blog/peluang-bisnis-online<br>
							<br>
							Salam web master
						';
						$kode_marketing = 15;
					}					
				}

				if($send_after == 'first') $tanggal_kirim = date('Y-m-d',strtotime($row->create_date.' +2 days'));
				elseif($send_after == 'second') $tanggal_kirim = date('Y-m-d',strtotime($row->create_date.' +4 days'));
				elseif($send_after == 'third') $tanggal_kirim = date('Y-m-d',strtotime($row->create_date.' +6 days'));

				if(date('Y-m-d') == $tanggal_kirim)
				{
					$data_kirim['popup_trial_id'] 			= $row->popup_trial_id;
					$data_kirim['popup_trial_marketing_id'] = $kode_marketing;
					$data_kirim['create_date'] 				= date('Y-m-d H:i:s');

					if($this->send_email($from,$recipient,$title,$content))
					{
						$data_kirim['is_send'] = 'yes';
					}
					else
					{
						$data_kirim['is_send'] = 'no';
					}

					$this->model_utama->insert_data('popup_trial_email',$data_kirim);


					if($send_after == 'third')
					{
						$data['send_all_email'] = 'yes';
						$this->model_utama->update_data($row->popup_trial_id,'popup_trial_id','popup_trial',$data);
					}
				}
			}			
		}
	}

	/************** end function ************/
}