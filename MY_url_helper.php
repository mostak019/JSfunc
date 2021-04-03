<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function current_url()
{
    $CI =& get_instance();
    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}

function website_url()
{
	return 'http://localhost/pharmacy-online/';
}

// function for sms
function sendsms($number, $message)
{
	$user = ""; 
	$pass = ""; 
	$sid = ""; 
	$url="http://sms.sslwireless.com/pushapi/dynamic/server.php";
	$param="user=$user&pass=$pass&sms[0][0]=$number&sms[0][1]=".urlencode($message)."&sid=$sid";
	$crl = curl_init();
	curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2);
	curl_setopt($crl,CURLOPT_URL,$url); 
	curl_setopt($crl,CURLOPT_HEADER,0);
	curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($crl,CURLOPT_POST,1);
	curl_setopt($crl,CURLOPT_POSTFIELDS,$param); 
	$response = curl_exec($crl);
	curl_close($crl);
}

function menu_item_activate($params=array())
{
	$CI =& get_instance();
	$url = $CI->load->helper('url');
	
	$segment = $url->uri->segment(1);
	
	if(in_array($segment, $params))
	{
		return 'active';
	}else
	{
		return null;
	}
	
}

function submenu_item_activate($url_param, $url_param2)
{
	$CI =& get_instance();
	$url = $CI->load->helper('url');
	
	$segment = $url->uri->segment(2);
	$segment2 = $url->uri->segment(3);
	
	if($segment == $url_param && $segment2 == $url_param2)
	{
		return 'active';
	}else
	{
		return null;
	}
	
}


function submenu_singleitem_queryactivate($url_param, $key, $value=null)
{
	$CI =& get_instance();
	$url = $CI->load->helper('url');
	
	$segment = $url->uri->segment(2);
	
	if($segment == $url_param && isset($_GET[$key]) && $_GET[$key] === $value)
	{
		return 'active';
	}else
	{
		return null;
	}
	
}

function submenu_item_queryactivate($url_param, $url_param2, $key, $value)
{
	$CI =& get_instance();
	$url = $CI->load->helper('url');
	
	$segment = $url->uri->segment(2);
	$segment2 = $url->uri->segment(3);
	
	if($segment == $url_param && $segment2 == $url_param2 && isset($_GET[$key]) && $_GET[$key] === $value)
	{
		return 'active';
	}else
	{
		return null;
	}
	
}

/******For Live Environment******/

function attachment_dir($param=null)
{
	if($param !== null)
	{
		if ($_SERVER['HTTP_HOST']=='ecockpit.saamsit.com') {
			$dir = $_SERVER['DOCUMENT_ROOT']."/attachments/".$param;
		}else{
			$dir = $_SERVER['DOCUMENT_ROOT']."/pharmacy-attachments/".$param;
		}
	}else
	{
		if ($_SERVER['HTTP_HOST']=='ecockpit.saamsit.com') {
			$dir = $_SERVER['DOCUMENT_ROOT']."/attachments/";
		}else{
			$dir = $_SERVER['DOCUMENT_ROOT']."/pharmacy-attachments/";
		}
	}
	
	return $dir;
}

function attachment_url($param=null)
{
	if($param !== null)
	{
		if($_SERVER['HTTP_HOST'] == 'ecom1.saamsit.com')
		{
			$url = "http://ecom1.saamsit.com/attachments/".$param;
		}else
		{
			$url = "http://localhost/pharmacy-attachments/".$param;
		}
	}else
	{
		if($_SERVER['HTTP_HOST'] == 'ecom1.saamsit.com')
		{
			$url = "http://ecom1.saamsit.com/attachments/";
		}else
		{
			$url = "http://localhost/pharmacy-attachments/";
		}
	}
	
	return $url;
}

function gallery_images_url($param=null)
{
	if($param !== null)
	{
		if($_SERVER['HTTP_HOST'] == 'ecom1.saamsit.com')
		{
			$url = "http://ecom1.saamsit.com/attachments/files/images/".$param;
		}else
		{
			$url = "http://localhost/pharmacy-attachments/files/images/".$param;
		}
	}else
	{
		if($_SERVER['HTTP_HOST'] == 'ecom1.saamsit.com')
		{
			$url = "http://ecom1.saamsit.com/attachments/files/images/";
		}else
		{
			$url = "http://localhost/pharmacy-attachments/files/images/";
		}
	}
	
	return $url;
}

function gallery_images_dir($param=null)
{
	if($param !== null)
	{
		if($_SERVER['HTTP_HOST'] == 'saamsit.com')
		{
			$dir = $_SERVER['DOCUMENT_ROOT']."/attachments/files/images/".$param;
		}else
		{
			$dir = $_SERVER['DOCUMENT_ROOT']."/pharmacy-attachments/files/images/".$param;
		}
	}else
	{
		if($_SERVER['HTTP_HOST'] == 'ecom1.saamsit.com')
		{
			$dir = $_SERVER['DOCUMENT_ROOT']."/attachments/files/images/";
		}else
		{
			$dir = $_SERVER['DOCUMENT_ROOT']."/pharmacy-attachments/files/images/";
		}
	}
	
	return $dir;
}

function users_directory($param=null)
{
	if($param !== null)
	{
		if ($_SERVER['HTTP_HOST']=='ecockpit.saamsit.com') {
			$dir = $_SERVER['DOCUMENT_ROOT']."/attachments/".$param;
		}else{
			$dir = $_SERVER['DOCUMENT_ROOT']."/ecockpit/attachments/".$param;
		}
	}else
	{
		if ($_SERVER['HTTP_HOST']=='ecockpit.saamsit.com') {
			$dir = $_SERVER['DOCUMENT_ROOT']."/attachments/";
		}else{
			$dir = $_SERVER['DOCUMENT_ROOT']."/ecockpit/attachments/";
		}
	}
	
	return $dir;
}


function mail_body($data=array())
{
	$html = '
	<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<title>Distance Learning Programme (DLP)</title>
	<style type="text/css">
		.main-title{
		color: #393939;
		text-align: left;
		text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
		}
		.main-title > span{
		color: #ffa500;
		font-weight: bold;
		text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
		}
		p.login-dtls{}
		p.regards-best{line-height:23px;}
		p {
		  color: #454545;
		  font-size: 14px;
		  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
		}
		.aftr-pid, .login-dtls{line-height:22px;}
		.mail-container-bdy{
			background: #fff;
			padding: 37px 50px 50px;
			margin: 0px 150px;
		}
		.main-body{
			background:#3C73B1;
			padding:100px 0px;
			margin:0;
		}
		@media (min-width: 320px) and (max-width: 480px) {
			.main-body {
			  background: #3c73b1 none repeat scroll 0 0;
			  margin: 0;
			  padding: 5px;
			}
			.mail-container-bdy {
			  background: #fff none repeat scroll 0 0;
			  margin: 0;
			  padding: 10px 25px 30px;
			}
		}
		@media (min-width: 360px) and (max-width: 640px) {
			.main-body {
			  background: #3c73b1 none repeat scroll 0 0;
			  margin: 0;
			  padding: 5px;
			}
			.mail-container-bdy {
			  background: #fff none repeat scroll 0 0;
			  margin: 0;
			  padding: 10px 25px 30px;
			}
		}
		@media (min-width: 768px) and (max-width: 1024px) {
			.main-body {
			  background: #3c73b1 none repeat scroll 0 0;
			  margin: 0;
			  padding: 5px;
			}
			.mail-container-bdy {
			  background: #fff none repeat scroll 0 0;
			  margin: 0;
			  padding: 10px 25px 30px;
			}
		}
		@media (min-width: 980px) and (max-width: 1280px) {}
		@media (min-width: 980px) and (max-width: 1280px) {}
	</style>
</head>
<body class="main-body">
	<div class="mail-container-bdy">
		'.$data['mail_title'].'
		'.$data['mail_content'].'
		<p class="regards-best">
			Thanks & Regards <br />
			<strong>Coordinator</strong> <br />
			Distance Learning Programme (DLP)
		</p>
	</div>
</body>
</html>
	';
	
	return $html;
}

function check_data_exist($field_name, $field_value, $table_name)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT $field_name FROM $table_name WHERE $field_name='$field_value' LIMIT 1");
	return $query->row_array();
}

function get_product_stock_qty($product_id)
{
	$CI =& get_instance();
	
	//stock adjustment increase qty
	$stock_adjust = $CI->db->query("SELECT SUM(adjust_qty) AS total_qty FROM saams_product_stock_adjust_infos 
									WHERE adjust_product_id='$product_id' 
									AND adjust_type='INCREASE' 
									AND adjust_has_deleted='NO' 
									LIMIT 1");
	$stock_adjust_result = $stock_adjust->row_array();
	if($stock_adjust_result['total_qty'])
	{
		$stock_adjustment_qty = $stock_adjust_result['total_qty'];
	}else{
		$stock_adjustment_qty = 0;
	}
	
	//stock purchase qty
	$stock_purchase = $CI->db->query("SELECT SUM(stock_qty) AS total_qty FROM saams_product_stock_purchase_infos 
									  WHERE stock_product_id='$product_id' 
									  AND stock_has_deleted='NO'
									  LIMIT 1");
	$stock_purchase_result = $stock_purchase->row_array();
	if($stock_purchase_result['total_qty'])
	{
		$stock_purchase_qty = $stock_purchase_result['total_qty'];
	}else{
		$stock_purchase_qty = 0;
	}
	
	//stock sales return qty
	$stock_sales_return = $CI->db->query("SELECT SUM(stock_return_qty) AS total_qty FROM saams_product_stock_sales_return_infos 
										  WHERE stock_return_product_id='$product_id' 
										  AND stock_return_has_deleted='NO'
										  LIMIT 1");
	$stock_sales_return_result = $stock_sales_return->row_array();
	if($stock_sales_return_result['total_qty'])
	{
		$stock_sales_return_qty = $stock_sales_return_result['total_qty'];
	}else{
		$stock_sales_return_qty = 0;
	}
	
	//Stock added total
	$stock_added_total = $stock_adjustment_qty + $stock_purchase_qty + $stock_sales_return_qty;
	
	//stock adjustment decrease qty
	$stock_adjust_decrease = $CI->db->query("SELECT SUM(adjust_qty) AS total_qty FROM saams_product_stock_adjust_infos 
									WHERE adjust_product_id='$product_id' 
									AND adjust_type='DECREASE' 
									AND adjust_has_deleted='NO' 
									LIMIT 1");
	$stock_adjust_decrease_result = $stock_adjust_decrease->row_array();
	if($stock_adjust_decrease_result['total_qty'])
	{
		$stock_adjustment_decrease_qty = $stock_adjust_decrease_result['total_qty'];
	}else{
		$stock_adjustment_decrease_qty = 0;
	}
	
	//Stock purchase return qty
	$stock_purchase_return = $CI->db->query("SELECT SUM(stock_return_qty) AS total_qty FROM saams_product_stock_purchase_return_infos 
											 WHERE stock_return_product_id='$product_id' 
											 AND stock_return_has_deleted='NO'
											 LIMIT 1");
	$stock_purchase_return_result = $stock_purchase_return->row_array();
	if($stock_purchase_return_result['total_qty'])
	{
		$stock_purchase_return_qty = $stock_purchase_return_result['total_qty'];
	}else{
		$stock_purchase_return_qty = 0;
	}
	
	//Stock sales qty
	$stock_sales = $CI->db->query("SELECT SUM(stock_qty) AS total_qty FROM saams_product_stock_sales_infos 
								   WHERE stock_product_id='$product_id' 
								   AND stock_has_deleted='NO'
								   LIMIT 1");
	$stock_sales_result = $stock_sales->row_array();
	if($stock_sales_result['total_qty'])
	{
		$stock_sales_qty = $stock_sales_result['total_qty'];
	}else{
		$stock_sales_qty = 0;
	}
	
	//Stock out total
	$stock_out_total = $stock_adjustment_decrease_qty + $stock_purchase_return_qty + $stock_sales_qty;
	
	//Final Stock Qty
	$final_product_stock_qty = $stock_added_total - $stock_out_total;
	return $final_product_stock_qty;
}

function get_product_stock_qty_by_variation_option($product_id, $variation_id, $option_id)
{
	$CI =& get_instance();
	
	//stock adjustment increase qty
	$stock_adjust = $CI->db->query("SELECT SUM(adjust_qty) AS total_qty FROM saams_product_stock_adjust_infos 
									WHERE adjust_product_id='$product_id' 
									AND adjust_type='INCREASE' 
									AND adjust_variation_id='$variation_id' 
									AND adjust_variation_option_id='$option_id' 
									AND adjust_has_deleted='NO'
									LIMIT 1");
	$stock_adjust_result = $stock_adjust->row_array();
	if($stock_adjust_result['total_qty'])
	{
		$stock_adjustment_qty = $stock_adjust_result['total_qty'];
	}else{
		$stock_adjustment_qty = 0;
	}
	
	//stock purchase qty
	$stock_purchase = $CI->db->query("SELECT SUM(stock_qty) AS total_qty FROM saams_product_stock_purchase_infos 
									  WHERE stock_product_id='$product_id'
									  AND stock_variation_id='$variation_id' 
									  AND stock_variation_option_id='$option_id'
									  AND stock_has_deleted='NO'
									  LIMIT 1");
	$stock_purchase_result = $stock_purchase->row_array();
	if($stock_purchase_result['total_qty'])
	{
		$stock_purchase_qty = $stock_purchase_result['total_qty'];
	}else{
		$stock_purchase_qty = 0;
	}
	
	//stock sales return qty
	$stock_sales_return = $CI->db->query("SELECT SUM(stock_return_qty) AS total_qty FROM saams_product_stock_sales_return_infos 
										  WHERE stock_return_product_id='$product_id'
										  AND stock_return_variation_id='$variation_id' 
										  AND stock_return_variation_option_id='$option_id'
										  AND stock_return_has_deleted='NO'
										  LIMIT 1");
	$stock_sales_return_result = $stock_sales_return->row_array();
	if($stock_sales_return_result['total_qty'])
	{
		$stock_sales_return_qty = $stock_sales_return_result['total_qty'];
	}else{
		$stock_sales_return_qty = 0;
	}
	
	//Stock added total
	$stock_added_total = $stock_adjustment_qty + $stock_purchase_qty + $stock_sales_return_qty;
	
	//stock adjustment decrease qty
	$stock_adjust_decrease = $CI->db->query("SELECT SUM(adjust_qty) AS total_qty FROM saams_product_stock_adjust_infos 
									WHERE adjust_product_id='$product_id' 
									AND adjust_type='DECREASE' 
									AND adjust_variation_id='$variation_id' 
									AND adjust_variation_option_id='$option_id' 
									AND adjust_has_deleted='NO'
									LIMIT 1");
	$stock_adjust_decrease_result = $stock_adjust_decrease->row_array();
	if($stock_adjust_decrease_result['total_qty'])
	{
		$stock_adjustment_decrease_qty = $stock_adjust_decrease_result['total_qty'];
	}else{
		$stock_adjustment_decrease_qty = 0;
	}
	
	//Stock purchase return qty
	$stock_purchase_return = $CI->db->query("SELECT SUM(stock_return_qty) AS total_qty FROM saams_product_stock_purchase_return_infos 
											 WHERE stock_return_product_id='$product_id'
											 AND stock_return_variation_id='$variation_id' 
											 AND stock_return_variation_option_id='$option_id'
											 AND stock_return_has_deleted='NO'
											 LIMIT 1");
	$stock_purchase_return_result = $stock_purchase_return->row_array();
	if($stock_purchase_return_result['total_qty'])
	{
		$stock_purchase_return_qty = $stock_purchase_return_result['total_qty'];
	}else{
		$stock_purchase_return_qty = 0;
	}
	
	//Stock sales qty
	$stock_sales = $CI->db->query("SELECT SUM(stock_qty) AS total_qty FROM saams_product_stock_sales_infos 
								   WHERE stock_product_id='$product_id'
								   AND stock_variation_id='$variation_id' 
								   AND stock_variation_option_id='$option_id'
								   AND stock_has_deleted='NO'
								   LIMIT 1");
	$stock_sales_result = $stock_sales->row_array();
	if($stock_sales_result['total_qty'])
	{
		$stock_sales_qty = $stock_sales_result['total_qty'];
	}else{
		$stock_sales_qty = 0;
	}
	
	//Stock out total
	$stock_out_total = $stock_adjustment_decrease_qty + $stock_purchase_return_qty + $stock_sales_qty;
	
	//Final Stock Qty
	$final_product_stock_qty = $stock_added_total - $stock_out_total;
	return $final_product_stock_qty;
}

function product_purchase_refundable_qty($purchase_order_id, $product_id)
{
	$CI =& get_instance();
	
	//purchase qty
	$stock_purchase = $CI->db->query("SELECT SUM(stock_qty) AS total_qty FROM saams_product_stock_purchase_infos 
									  WHERE stock_order_id='$purchase_order_id' 
									  AND stock_product_id='$product_id' 
									  AND stock_has_deleted='NO'
									  LIMIT 1");
	$stock_purchase_result = $stock_purchase->row_array();
	if($stock_purchase_result['total_qty'])
	{
		$stock_purchase_qty = $stock_purchase_result['total_qty'];
	}else{
		$stock_purchase_qty = 0;
	}
	
	//purchase qty total
	$stock_purchase_qty_total = $stock_purchase_qty;
	
	//purchase return qty
	$stock_purchase_return = $CI->db->query("SELECT SUM(stock_return_qty) AS total_qty FROM saams_product_stock_purchase_return_infos 
											 WHERE stock_return_order_id='$purchase_order_id' 
											 AND stock_return_product_id='$product_id' 
											 AND stock_return_has_deleted='NO'
											 LIMIT 1");
	$stock_purchase_return_result = $stock_purchase_return->row_array();
	if($stock_purchase_return_result['total_qty'])
	{
		$stock_purchase_return_qty = $stock_purchase_return_result['total_qty'];
	}else{
		$stock_purchase_return_qty = 0;
	}
	
	//purchase return qty total
	$stock_purchase_return_qty_total = $stock_purchase_return_qty;
	
	//Final refundable qty
	$final_product_refundable_qty = $stock_purchase_qty_total - $stock_purchase_return_qty_total;
	return $final_product_refundable_qty;
}

function product_purchase_refundable_qty_by_variation($purchase_order_id, $product_id, $variation_id, $option_id)
{
	$CI =& get_instance();
	
	//stock purchase qty
	$stock_purchase = $CI->db->query("SELECT SUM(stock_qty) AS total_qty FROM saams_product_stock_purchase_infos 
									  WHERE stock_order_id='$purchase_order_id'
									  AND stock_product_id='$product_id'
									  AND stock_variation_id='$variation_id' 
									  AND stock_variation_option_id='$option_id'
									  AND stock_has_deleted='NO'
									  LIMIT 1");
	$stock_purchase_result = $stock_purchase->row_array();
	if($stock_purchase_result['total_qty'])
	{
		$stock_purchase_qty = $stock_purchase_result['total_qty'];
	}else{
		$stock_purchase_qty = 0;
	}
	
	//stock purchase qty total
	$stock_purchase_qty_total = $stock_purchase_qty;
	
	//Stock purchase return qty
	$stock_purchase_return = $CI->db->query("SELECT SUM(stock_return_qty) AS total_qty FROM saams_product_stock_purchase_return_infos 
											 WHERE stock_return_order_id='$purchase_order_id'
											 AND stock_return_product_id='$product_id'
											 AND stock_return_variation_id='$variation_id' 
											 AND stock_return_variation_option_id='$option_id'
											 AND stock_return_has_deleted='NO'
											 LIMIT 1");
	$stock_purchase_return_result = $stock_purchase_return->row_array();
	if($stock_purchase_return_result['total_qty'])
	{
		$stock_purchase_return_qty = $stock_purchase_return_result['total_qty'];
	}else{
		$stock_purchase_return_qty = 0;
	}
	
	//Stock purchase return qty total
	$stock_purchase_return_qty_total = $stock_purchase_return_qty;
	
	//Final refundable qty
	$final_product_refundable_qty = $stock_purchase_qty_total - $stock_purchase_return_qty_total;
	return $final_product_refundable_qty;
}

function product_sales_refundable_qty($sales_order_id, $product_id)
{
	$CI =& get_instance();
	
	//sales qty
	$stock_sales = $CI->db->query("SELECT SUM(stock_qty) AS total_qty FROM saams_product_stock_sales_infos 
								   WHERE stock_order_id='$sales_order_id' 
								   AND stock_product_id='$product_id' 
								   AND stock_has_deleted='NO'
								   LIMIT 1");
	$stock_sales_result = $stock_sales->row_array();
	if($stock_sales_result['total_qty'])
	{
		$stock_sales_qty = $stock_sales_result['total_qty'];
	}else{
		$stock_sales_qty = 0;
	}
	
	//sales qty total
	$stock_sales_qty_total = $stock_sales_qty;
	
	//sales return qty
	$stock_sales_return = $CI->db->query("SELECT SUM(stock_return_qty) AS total_qty FROM saams_product_stock_sales_return_infos 
										  WHERE stock_return_order_id='$sales_order_id' 
										  AND stock_return_product_id='$product_id' 
										  AND stock_return_has_deleted='NO'
										  LIMIT 1");
	$stock_sales_return_result = $stock_sales_return->row_array();
	if($stock_sales_return_result['total_qty'])
	{
		$stock_sales_return_qty = $stock_sales_return_result['total_qty'];
	}else{
		$stock_sales_return_qty = 0;
	}
	
	//sales return qty total
	$stock_sale_return_qty_total = $stock_sales_return_qty;
	
	//Final refundable qty
	$final_product_refundable_qty = $stock_sales_qty_total - $stock_sale_return_qty_total;
	return $final_product_refundable_qty;
}

function product_sales_refundable_qty_by_variation($sales_order_id, $product_id, $variation_id, $option_id)
{
	$CI =& get_instance();
	
	//Stock sales qty
	$stock_sales = $CI->db->query("SELECT SUM(stock_qty) AS total_qty FROM saams_product_stock_sales_infos 
								   WHERE stock_order_id='$sales_order_id'
								   AND stock_product_id='$product_id'
								   AND stock_variation_id='$variation_id' 
								   AND stock_variation_option_id='$option_id'
								   AND stock_has_deleted='NO'
								   LIMIT 1");
	$stock_sales_result = $stock_sales->row_array();
	if($stock_sales_result['total_qty'])
	{
		$stock_sales_qty = $stock_sales_result['total_qty'];
	}else{
		$stock_sales_qty = 0;
	}
	
	//Stock sales qty total
	$stock_sales_qty_total = $stock_sales_qty;
	
	//stock sales return qty
	$stock_sales_return = $CI->db->query("SELECT SUM(stock_return_qty) AS total_qty FROM saams_product_stock_sales_return_infos 
										  WHERE stock_return_order_id='$sales_order_id'
										  AND stock_return_product_id='$product_id'
										  AND stock_return_variation_id='$variation_id' 
										  AND stock_return_variation_option_id='$option_id'
										  AND stock_return_has_deleted='NO'
										  LIMIT 1");
	$stock_sales_return_result = $stock_sales_return->row_array();
	if($stock_sales_return_result['total_qty'])
	{
		$stock_sales_return_qty = $stock_sales_return_result['total_qty'];
	}else{
		$stock_sales_return_qty = 0;
	}
	
	//Stock sales return qty total
	$stock_sales_return_total = $stock_sales_return_qty;
	
	
	//Final Stock Qty
	$final_product_refundable_qty = $stock_sales_qty_total - $stock_sales_return_total;
	return $final_product_refundable_qty;
}

function get_company_info()
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT * FROM saams_company_informations WHERE company_key='COMPANY' LIMIT 1");
	return $query->row_array();
}

function get_company_logo_url($has_pdf=false)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT company_logo FROM saams_company_informations WHERE company_key='COMPANY' LIMIT 1");
	$result = $query->row_array();
	if($result)
	{
		if($has_pdf == true)
		{
			$photo_url = attachment_dir('setup/company/'.$result['company_logo']);
		}else{
			$photo_url = attachment_url('setup/company/'.$result['company_logo']);
		}
		return $photo_url;
	}else
	{
		if($has_pdf == true)
		{
			$photo_url = attachment_dir('backend/tools/no-image.png');
		}else{
			$photo_url = attachment_url('backend/tools/no-image.png');
		}
		return $photo_url;
	}
}

function convert_number($number) {
	if (($number < 0) || ($number > 999999999)) {
		throw new Exception("Number is out of range");
	}

	$Gn = floor($number / 1000000);
	/* Millions (giga) */
	$number -= $Gn * 1000000;
	$kn = floor($number / 1000);
	/* Thousands (kilo) */
	$number -= $kn * 1000;
	$Hn = floor($number / 100);
	/* Hundreds (hecto) */
	$number -= $Hn * 100;
	$Dn = floor($number / 10);
	/* Tens (deca) */
	$n = $number % 10;
	/* Ones */

	$res = "";

	if ($Gn) {
		$res .= convert_number($Gn) .  "Million";
	}

	if ($kn) {
		$res .= (empty($res) ? "" : " ") .convert_number($kn) . " Thousand";
	}

	if ($Hn) {
		$res .= (empty($res) ? "" : " ") .convert_number($Hn) . " Hundred";
	}

	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
	$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

	if ($Dn || $n) {
		if (!empty($res)) {
			$res .= " and ";
		}

		if ($Dn < 2) {
			$res .= $ones[$Dn * 10 + $n];
		} else {
			$res .= $tens[$Dn];

			if ($n) {
				$res .= "-" . $ones[$n];
			}
		}
	}

	if (empty($res)) {
		$res = "zero";
	}

	return $res;
}
        
        
function bangla_font($str='')
{
	if(strlen($str))
	{
		$str = str_replace("0", "০", $str);
		$str = str_replace("1", "১", $str);
		$str = str_replace("2", "২", $str);
		$str = str_replace("3", "৩", $str);
		$str = str_replace("4", "৪", $str);
		$str = str_replace("5", "৫", $str);
		$str = str_replace("6", "৬", $str);
		$str = str_replace("7", "৭", $str);
		$str = str_replace("8", "৮", $str);
		$str = str_replace("9", "৯", $str);
		/*$length=strlen($str);
		for($loop=0;$loop<$length;$loop++)
		{
			
			if($token=='0')
			{
				$str[$loop]='০';
			}
			if($token=='1')
			{
				$str[$loop]='X';
			}
			if($token=='2')
			{
				$str[$loop]='২';
			}
			if($token=='3')
			{
				$str[$loop]='৩';
			}
			if($token=='4')
			{
				$str[$loop]='৪';
			}
			if($token=='5')
			{
				$str[$loop]='৫';
			}
			if($token=='6')
			{
				$str[$loop]='৬';
			}
			if($token=='7')
			{
				$str[$loop]='৭';
			}
			if($token=='8')
			{
				$str[$loop]='৮';
			}
			if($token=='9')
			{
				$str[$loop]='৯';
			}
		}*/
	}
	//$str=utf8_encode($str);
	return $str;
}

function convertToBdCurrency($number) {
    $no = round($number);
    $decimal = round($number - ($no = floor($number)), 2) * 100;    
    $digits_length = strlen($no);    
    $i = 0;
    $str = array();
    $words = array(
        0 => '',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lac', 'Crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
        } else {
            $str [] = null;
        }  
    }
    
    $Rupees = implode(' ', array_reverse($str));
    $paise = ($decimal) ? "And Paisa " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10])  : '';
    return ($Rupees ? $Rupees : '') . $paise . " Taka Only";
}

function get_product_photo_url($product_id, $type=null)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT 
							   saams_gallery_images.photo_serial_id,
							   saams_gallery_images.photo_name_raw,
							   saams_gallery_images.photo_name_ext
							   
							   FROM saams_products_gallery
							   
							   LEFT JOIN saams_gallery_images ON
							   saams_gallery_images.photo_id=saams_products_gallery.gallery_image_id
							   
							   WHERE gallery_product_id='$product_id'
							   
							   ORDER BY gallery_id ASC LIMIT 1");
	$result = $query->row_array();
	if($result)
	{
		$photo_url = gallery_images_url($result['photo_serial_id'].'/'.$result['photo_name_raw'].'_xs_thumb'.$result['photo_name_ext']);
		return $photo_url;
	}else
	{
		if($type=='DRUGS'){
			$photo_url = base_url('backend/tools/drug-no-photo.jpg');
		}else{
			$photo_url = base_url('backend/tools/no-image.png');
		}
		return $photo_url;
	}
}

function get_product_photo_dir($product_id, $type=null)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT 
							   saams_gallery_images.photo_serial_id,
							   saams_gallery_images.photo_name_raw,
							   saams_gallery_images.photo_name_ext
							   
							   FROM saams_products_gallery
							   
							   LEFT JOIN saams_gallery_images ON
							   saams_gallery_images.photo_id=saams_products_gallery.gallery_image_id
							   
							   WHERE gallery_product_id='$product_id'
							   
							   ORDER BY gallery_id ASC LIMIT 1");
	$result = $query->row_array();
	if($result)
	{
		$photo_url = gallery_images_dir($result['photo_serial_id'].'/'.$result['photo_name_raw'].'_xs_thumb'.$result['photo_name_ext']);
		return $photo_url;
	}else
	{
		if($type=='DRUGS'){
			$photo_url = attachment_dir('backend/tools/drug-no-photo.jpg');
		}else{
			$photo_url = attachment_dir('backend/tools/no-image.png');
		}
		return $photo_url;
	}
}

function get_customer_photo_url($customer_id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT customer_formatted_id, customer_profile_photo FROM saams_customers WHERE customer_id='$customer_id' LIMIT 1");
	$result = $query->row_array();
	if($result['customer_profile_photo'])
	{
		$photo_url = attachment_url('customers/'.$result['customer_formatted_id'].'/'.$result['customer_profile_photo']);
		return $photo_url;
	}else
	{
		$photo_url = attachment_url('backend/tools/no-image.png');
		return $photo_url;
	}
}

function get_admin_photo_url($admin_id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT admin_formatted_id, admin_profile_photo FROM saams_administrators WHERE admin_id='$admin_id' LIMIT 1");
	$result = $query->row_array();
	if($result['admin_profile_photo'])
	{
		$photo_url = attachment_url('administrators/'.$result['admin_formatted_id'].'/'.$result['admin_profile_photo']);
		return $photo_url;
	}else
	{
		$photo_url = attachment_url('backend/tools/no-image.png');
		return $photo_url;
	}
}

function format_date($date=null)
{
	if($date !== null)
	{
		return date("Y-m-d", strtotime($date));
	}else{
		return null;
	}
}

function save_file_info($to, $data)
{
	$CI  =& get_instance();
	$CI->db->insert($to, $data);
}

function check_order_has_refunded($type, $order_id)
{
	$CI =& get_instance();
	if($type == 'PURCHASE')
	{
		$query = $CI->db->query("SELECT refund_id
								 FROM saams_purchase_refunds  
								 WHERE refund_order_id='$order_id'
								 AND refund_has_deleted='NO'
								 ");
		$result = $query->row_array();
		if($result == true)
		{
			return 'YES';
		}
	}
	
	if($type == 'SALES')
	{
		$query = $CI->db->query("SELECT refund_id
								 FROM saams_sales_refunds  
								 WHERE refund_order_id='$order_id'
								 AND refund_has_deleted='NO'
								 ");
		$result = $query->row_array();
		if($result == true)
		{
			return 'YES';
		}
	}
		
	return 'NO';
}

function check_product_has_refunded($type, $order_id, $product_id)
{
	$CI =& get_instance();
	if($type == 'PURCHASE')
	{
		$query = $CI->db->query("SELECT refitem_id, refund_has_deleted
								 FROM saams_purchase_refunds_items 
								 
								 LEFT JOIN saams_purchase_refunds ON
								 saams_purchase_refunds.refund_id=saams_purchase_refunds_items.refitem_refund_id
								 
								 WHERE refitem_order_id='$order_id' 
								 AND refitem_product_id='$product_id'
								 AND refund_has_deleted='NO'
								 ");
		$result = $query->row_array();
		if($result == true)
		{
			return 'YES';
		}
	}
	
	if($type == 'SALES')
	{
		$query = $CI->db->query("SELECT refitem_id, refund_has_deleted
								 FROM saams_sales_refunds_items 
								 
								 LEFT JOIN saams_sales_refunds ON
								 saams_sales_refunds.refund_id=saams_sales_refunds_items.refitem_refund_id
								 
								 WHERE refitem_order_id='$order_id' 
								 AND refitem_product_id='$product_id'
								 AND refund_has_deleted='NO'
								 ");
		$result = $query->row_array();
		if($result == true)
		{
			return 'YES';
		}
	}
		
	return 'NO';
}

function get_the_supplier_balance($supplier_id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT balance_type, balance_amount FROM saams_suppliers_balances 
							WHERE balance_supplier_id='$supplier_id' 
							ORDER BY balance_id DESC LIMIT 1");
	$result = $query->row_array();
	if($result == true)
	{
		return array(
					'balance_type'   => $result['balance_type'],
					'balance_amount' => $result['balance_amount'],
				);
	}else
	{
		return array(
					'balance_type'   => '',
					'balance_amount' => '',
				);
	}
}

function get_the_customer_balance($customer_id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT balance_type, balance_amount FROM saams_customers_balances 
							 WHERE balance_customer_id='$customer_id'  
							 ORDER BY balance_id DESC LIMIT 1");
	$result = $query->row_array();
	if($result == true)
	{
		return array(
					'balance_type'   => $result['balance_type'],
					'balance_amount' => $result['balance_amount'],
				);
	}else
	{
		return array(
					'balance_type'   => '',
					'balance_amount' => '',
				);
	}
}

function get_accounts_by_type($type)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT account_id, account_type, account_title, account_number FROM saams_accounts WHERE account_type='$type' ORDER BY account_title ASC");
	return $query->result_array();
}

function get_invoice_number($field_name, $type, $id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT invoice_number FROM saams_invoices WHERE $field_name='$id' AND invoice_type='$type' LIMIT 1");
	$result = $query->row_array();
	return $result['invoice_number'];
}

function get_supplier_due_invoices($supplier_id)
{
	$CI =& get_instance();
	$due_invoices = array();
	$query = $CI->db->query("SELECT 
							invoice_number,
							order_number, 
							order_formatted_id, 
							due_invoice_id, 
							due_order_id, 
							due_invoice_net_total, 
							due_paid_total,
							due_amount_total

							FROM saams_suppliers_payments_dues

							LEFT JOIN saams_purchase_orders ON
							saams_purchase_orders.order_id=saams_suppliers_payments_dues.due_order_id

							LEFT JOIN saams_invoices ON
							saams_invoices.invoice_id=saams_suppliers_payments_dues.due_invoice_id

							WHERE due_supplier_id='$supplier_id'
							AND due_status='DUE'
							AND due_has_deleted='NO'
							ORDER BY due_id ASC");
	$results = $query->result_array();
	foreach($results as $result)
	{
		if(invoice_has_payment_cleared($result['due_invoice_id'], $result['due_invoice_net_total']))
		{
			continue;
		}
		$due_invoices[] = array(
								'invoice_number'        => $result['invoice_number'],
								'order_number'          => $result['order_number'],
								'order_formatted_id'    => $result['order_formatted_id'],
								'due_invoice_id'        => $result['due_invoice_id'],
								'due_order_id'          => $result['due_order_id'],
								'due_invoice_net_total' => $result['due_invoice_net_total'],
								'due_paid_total'        => $result['due_paid_total'],
								'due_amount_total'      => $result['due_amount_total'],
							);
	}
	
	return $due_invoices;
}

function invoice_has_payment_cleared($invoice_id, $invoice_net_total)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT SUM(pinvoice_payment_amount) AS total_amount FROM saams_suppliers_payments_invoices WHERE pinvoice_invoice_id='$invoice_id' LIMIT 1");
	$result = $query->row_array();
	if($result['total_amount'])
	{
		if($result['total_amount'] == $invoice_net_total)
		{
			return true;
		}
	}
	
	return false;
}

function get_cheque_scan_url($cheque_id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT cheque_serial, cheque_scan_copy FROM saams_accounts_bank_cheques WHERE cheque_id='$cheque_id' LIMIT 1");
	$result = $query->row_array();
	if($result)
	{
		$photo_url = attachment_url('files/cheques/'.$result['cheque_serial'].'/'.$result['cheque_scan_copy']);
		return $photo_url;
	}else
	{
		$photo_url = attachment_url('backend/tools/no-image.png');
		return $photo_url;
	}
}
function get_receipt_scan_url($fundtransfer_id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT fundtransfer_serial, fundtransfer_scan_copy FROM saams_accounts_bank_fund_transfers WHERE fundtransfer_id='$fundtransfer_id' LIMIT 1");
	$result = $query->row_array();
	if($result)
	{
		$photo_url = attachment_url('files/transfer-receipts/'.$result['fundtransfer_serial'].'/'.$result['fundtransfer_scan_copy']);
		return $photo_url;
	}else
	{
		$photo_url = attachment_url('backend/tools/no-image.png');
		return $photo_url;
	}
}
function get_supplier_invoice_payment_amount($payment_id, $invoice_id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT pinvoice_payment_amount FROM saams_suppliers_payments_invoices WHERE pinvoice_payment_id='$payment_id' AND pinvoice_invoice_id='$invoice_id' LIMIT 1");
	$result = $query->row_array();
	if($result['pinvoice_payment_amount'])
	{
		return $result['pinvoice_payment_amount'];
	}
	
	return 0;
}

function show_date($date)
{
	if($date)
	{
		return date("d F, Y", strtotime($date));
	}
	
	return null;
}

function show_date_time($date)
{
	if($date)
	{
		return date("d F, Y", strtotime($date)).' '.date("g:i A", strtotime($date));
	}
	
	return null;
}

function show_amount($amount)
{
	return number_format(floatval($amount), 0, '.', ',');
}