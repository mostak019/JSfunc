<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function do_account_transaction($data)
{
	$CI =& get_instance();
	$CI->load->library('accountclass', $data);
	$transaction_id = $CI->accountclass->execute();
	return $transaction_id;
}

function get_account_balance($account_id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT balance_amount FROM saams_accounts_balances 
							 WHERE balance_account_id='$account_id'  
							 ORDER BY balance_id DESC LIMIT 1");
	$result = $query->row_array();
	if($result == true)
	{
		return $result['balance_amount'];
	}else
	{
		return 0;
	}
}

function by($user_id)
{
	$CI =& get_instance();
	$query = $CI->db->query("SELECT admin_full_name FROM saams_administrators WHERE admin_id='$user_id'");
	$result = $query->row_array();
	if($result['admin_full_name'])
	{
		return $result['admin_full_name'];
	}
	
	return null;
}

/*************Invoice payment related functions*****************/
function invoice_paid_total($invoice_id)
{
	$CI =& get_instance();
	$total_paid_amount = 0;
	$total_cheque_pending_or_bounch_amount = 0;
	$total_fundtransfers_pending_or_bounch_amount = 0;
	
	//Total paid amount
	$query1 = $CI->db->query("SELECT SUM(pinvoice_payment_amount) AS total_amount 
							 FROM saams_suppliers_payments_invoices 
							 WHERE pinvoice_invoice_id='$invoice_id'");
	$result1 = $query1->row_array();
	if($result1['total_amount'])
	{
		$total_paid_amount = $result1['total_amount'];
	}
	
	//Total cheque pending or bounch amount
	$query2 = $CI->db->query("SELECT SUM(pinvoice_cheque_payment_amount) AS total_amount 
							 FROM saams_suppliers_payments_invoices_cheques 
							 WHERE pinvoice_invoice_id='$invoice_id'
							 AND pinvoice_payment_status<>'DEPOSIT'");
	$result2 = $query2->row_array();
	if($result2['total_amount'])
	{
		$total_cheque_pending_or_bounch_amount = $result2['total_amount'];
	}
	
	//Total fund transfers pending or bounch amount
	$query3 = $CI->db->query("SELECT SUM(pinvoice_fundtransfer_payment_amount) AS total_amount 
							 FROM saams_suppliers_payments_invoices_fundtransfers 
							 WHERE pinvoice_invoice_id='$invoice_id'
							 AND pinvoice_payment_status<>'DEPOSIT'");
	$result3 = $query3->row_array();
	if($result3['total_amount'])
	{
		$total_fundtransfers_pending_or_bounch_amount = $result3['total_amount'];
	}
	$reduce_amount = $total_cheque_pending_or_bounch_amount + $total_fundtransfers_pending_or_bounch_amount;
	$paid_total = $total_paid_amount - $reduce_amount;
	
	return $paid_total;
}

function invoice_net_total($invoice_id)
{
	$CI =& get_instance();
	$total_net_amount = 0;
	$query = $CI->db->query("SELECT due_invoice_net_total 
							 FROM saams_suppliers_payments_dues 
							 WHERE due_invoice_id='$invoice_id'");
	$result = $query->row_array();
	if($result['due_invoice_net_total'])
	{
		$total_net_amount = $result['due_invoice_net_total'];
	}
	
	return $total_net_amount;
}

function invoice_due_total($invoice_id)
{
	$CI =& get_instance();
	$total_net_amount = invoice_net_total($invoice_id);
	$total_paid_amount = invoice_paid_total($invoice_id);
	$total_due_amount = $total_net_amount - $total_paid_amount;
	
	return $total_due_amount;
}

function pay_to_invoice_by_supplier_balance($data)
{
	$CI =& get_instance();
	$CI->db->insert('saams_suppliers_payments_invoices', $data);
}

function invoice_payment_status($invoice_id)
{
	$invoice_due_total = invoice_due_total($invoice_id);
	if($invoice_due_total == 0)
	{
		return 'PAID';
	}else{
		return 'DUE';
	}
}

function update_invoice_due_status($invoice_id, $data)
{
	$CI =& get_instance();
	$CI->db->where('due_invoice_id', $invoice_id);
	$CI->db->update('saams_suppliers_payments_dues', $data);
}