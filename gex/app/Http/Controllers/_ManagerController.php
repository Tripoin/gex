<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\MasterDocument;
use App\MasterCustomer;
use App\MasterVendor;
use App\MasterUnit;
use App\MasterPort;
use App\Reference;
use App\JobSheet;
use App\Revision;
use App\Payable;
use App\User;
use App\RC;
use App\Reimbursement;
use App\Payment;
use App\PaymentDoc;
use App\RequestModel;

use App\MasterRate;
use App\InvoiceDocument;
use App\ReceivablePayment;
use App\Receivable;
use App\Invoice;
use PDF;

class _ManagerController extends Controller
{
    //
    public function __construct()
	{
		$this->middleware('role:manager,admin');
	}

	public function listpayment(Request $request)
    {
        // $jobsheets = RequestModel::where('status','created')->where('type','!=','marketing')->get();
        $jobsheets = Payment::where('status','created')->where('type','!=','marketing')->get();

        return view('payable._listpayment', compact('jobsheets'));
    }

    public function listpaymentrc(Request $request)
    {
        // $jobsheets = RequestModel::where('status','created')->where('type','!=','marketing')->get();
        $jobsheets = Payment::where('status','created')->where('type','marketing')->get();

        return view('payable._listpayment', compact('jobsheets'));
    }

    public function showpayment(Request $request, $id, $role)
    {
        $roles = $role;

        if ($role == 'operation' || $role == 'pricing') {
            $payment = Payment::find($id);
            $payable = Payable::where('payment_id',$payment->id)->get();
            $paydoc = PaymentDoc::where('payment_id',$payment->id)->get();
            $sum_amount = PaymentDoc::where('payment_id',$payment->id)->sum('add_amount');

            return view('payable._showpayment', compact('payment','payable','paydoc','sum_amount','roles'));
        } elseif ($role == 'marketing') {
            $payment = Payment::find($id);
            $payable = RC::where('payment_id',$payment->id)->get();
            $paydoc = PaymentDoc::where('payment_id',$payment->id)->get();
            $sum_amount = PaymentDoc::where('payment_id',$payment->id)->sum('add_amount');

            return view('payable._showpayment', compact('payment','payable','paydoc','sum_amount','roles'));
        }
    }

    public function approvepayment(Request $request, $id, $role)
    {
        $payment = Payment::find($id);
        $payment->status = 'approved';
        $payment->save();

        if ($role == 'operation' || $role == 'pricing') {
            return redirect('/approve/payment');
        } elseif ($role == 'marketing') {
            return redirect('/approve/payment-rc');
        }
    }

    public function rejectpayment(Request $request, $id, $role)
    {
        $payment = Payment::find($id);
        // $payment->status = 'reject';
        // $payment->save();

        if ($role == 'operation' || $role == 'pricing') {

            $payable = Payable::where('payment_id', $id)->get();

            for ($i=0; $i < count($payable); $i++) {
                $pay = Payable::where('payment_id', $payment->id)->first();
                $pay->rate = null;
                $pay->payment_id = null;
                $pay->save();

                $request = RequestModel::where('payable_id', $payable[$i]->id)->where('type','!=','marketing')->first();
                $request->status = 'requested';
                $request->save();
            }

            $paymentdoc = PaymentDoc::where('payment_id', $payment->id)->get();

            foreach ($paymentdoc as $key) {
                $key->delete();
            }

            $payment->delete();

            return redirect('/approve/payment');
        } elseif ($role == 'marketing') {

            $rc = RC::where('payment_id', $id)->get();

            for ($i=0; $i < count($rc); $i++) {
                $rcc = RC::where('payment_id', $payment->id)->first();
                $rcc->rate = null;
                $rcc->payment_id = null;
                $rcc->save();

                $request = RequestModel::where('payable_id', $rc[$i]->id)->where('type','marketing')->first();
                $request->status = 'requested';
                $request->save();
            }

            $paymentdoc = PaymentDoc::where('payment_id', $payment->id)->get();

            foreach ($paymentdoc as $key) {
                $key->delete();
            }

            $payment->delete();

            return redirect('/approve/payment-rc');
        }
    }

    public function payable(Request $request)
    {
        // $jobsheets = RequestModel::where('status','created')->where('type','!=','marketing')->get();
        $jobsheets = Payment::where('status','approved')->where('type','!=','marketing')->get();

        return view('payable._listpayment', compact('jobsheets'));
    }

    public function paymentrc(Request $request)
    {
        // $jobsheets = RequestModel::where('status','created')->where('type','!=','marketing')->get();
        $jobsheets = Payment::where('status','approved')->where('type','marketing')->get();

        return view('payable._listpayment', compact('jobsheets'));
    }

    public function report(Request $request, Datatables $datatables)
    {
        $jobsheets = JobSheet::all();

        // return json_encode($jobsheets);
        return view('report.approval', compact('jobsheets'));
    }

    /* App Rec */

    public function invoicecancel()
    {
        $invoicerec = invoice::where('status', 2)->get();

        return view('receivable._index', compact('invoicerec'));
    }

    public function invoice()
    {
        $invoicerec = invoice::where('status',4)->get();

        return view('receivable._index', compact('invoicerec'));
    }

    public function show(Request $request, $id, $type)
    {
        if($type == 'receivable') {
            $invoice = Invoice::find($id);
            $jobsheet = JobSheet::find($invoice->jobsheet_id);
            $charges = Receivable::where('rec_invoice_id', $invoice->id)->get();
            $references = Reference::where('jobsheet_id', $id)->get();

            $receivables = Receivable::where('rec_invoice_id', $invoice->id)->first();

            $max = $charges->max('rec_total');
            $tot = $charges->sum('rec_total');
        } elseif ($type == 'reimbursement') {
            $invoice = Invoice::find($id);
            $jobsheet = JobSheet::find($invoice->jobsheet_id);
            $charges = Reimbursement::where('rmb_invoice_id', $invoice->id)->get();
            $references = Reference::where('jobsheet_id', $id)->get();

            $receivables = Reimbursement::where('rmb_invoice_id', $invoice->id)->first();

            $max = $charges->max('rmb_total');
            $tot = $charges->sum('rmb_total');
        }

        return view('receivable._show', compact('invoice','jobsheet','charges','references','receivables','max','tot','type'));
    }

    public function pdf(Request $request, $id, $type) {
        if($type == 'receivable') {
            $invoice = Invoice::find($id);
            $arr = Receivable::where('rec_invoice_id', $invoice->id)->get();
            $receivable = $arr->toArray();
            $document = InvoiceDocument::where('invoice_id', $invoice->id)->get();
            $max = $arr->max('rec_total');
            $tot = $arr->sum('rec_total');
            $pdf = PDF::loadView('invoice.printgexpdf', compact('invoice','receivable','max','tot','document'))->setPaper('a4', 'portrait');
            return $pdf->stream('invoice-receivable.pdf');
        } elseif ($type == 'reimbursement') {
            $invoice = Invoice::find($id);
            $arr = Reimbursement::where('rmb_invoice_id', $invoice->id)->get();
            $receivable = $arr->toArray();
            $document = InvoiceDocument::where('invoice_id', $invoice->id)->get();
            $max = $arr->max('rmb_total');
            $tot = $arr->sum('rmb_total');
            $pdf = PDF::loadView('invoice.printgexrmbpdf', compact('invoice','receivable','max','tot','document'))->setPaper('a4', 'portrait');
            return $pdf->stream('invoice-reimbursement.pdf');
        }
    }

    public function approve(Request $request, $id)
    {
        $invoice = invoice::find($id);
        $invoice->status = 1;
        $invoice->save();

        return redirect()->route('approverec.invoice');
    }

    public function approverevisi(Request $request, $id)
    {
        $invoice = invoice::find($id);
        $invoice->status = 5;
        $invoice->save();

        return redirect()->route('approverec.invoicecancel');
    }

    public function decline(Request $request, Datatables $datatables, $id)
    {
        $jobsheet_id    = JobSheet::find($id);
        // $jobsheet_id    = $request->jobsheet_id;
        $sender_id      = $request->sender_id;
        $note           = $request->note;
        $receiver       = $request->receiver;
        $role           = User::find($receiver);

        // Revision::create([
        //     'jobsheet_id'   => $jobsheet_id,
        //     'sender'        => $sender_id,
        //     'receiver'      => $receiver,
        //     'note'          => $note,
        //     'role'          => $role->role
        // ]);

        $revisi = new Revision;
        $revisi->jobsheet_id = $jobsheet_id;
        $revisi->sender = $sender_id;
        $revisi->receiver = $receiver;
        $revisi->note = $note;
        $revisi->role = $role->role;
        $revisi->timestamps = true;
        $revisi->save();

        $jobsheet = JobSheet::find($jobsheet_id);
        $jobsheet->status = 'revisi';
        $jobsheet->save();

        return redirect()->route('approverec.invoice');
    }

    public function jobsheet_index(Request $request, Datatables $datatables)
    {
          $jobsheets = JobSheet::where('status',['completed','uncompleted'])->get();

          return view('jobsheet.index', compact('jobsheets'));
    }

    public function jobsheet_show(Request $request, $id)
    {
        $jobsheet = JobSheet::find($id);
        $references = Reference::where('jobsheet_id', $jobsheet->id)->get();
        $payables = Payable::where('jobsheet_id', $jobsheet->id)->get();
        $reimbursements = Reimbursement::where('jobsheet_id', $id)->get();
        $rcs = RC::where('jobsheet_id', $id)->get();

        $pay_total_price = $payables->sum('price');
        $pay_total_price_idr = $payables->where('currency',1);
        $pay_total_price_usd = $payables->where('currency',2);

        $rmb_total_price = $reimbursements->sum('rmb_price');
        $rmb_total_price_idr = $reimbursements->where('rmb_currency',1);
        $rmb_total_price_usd = $reimbursements->where('rmb_currency',2);

        $rc_total_price  = $rcs->sum('rc_price');
        $rc_total_price_idr = $rcs->where('rc_currency',1);
        $rc_total_price_usd = $rcs->where('rc_currency',2);

        if (count($payables) > 0) {
            return view('jobsheet.manager.show', compact('jobsheet','references','payables','reimbursements','rcs','pay_total_price','pay_total_price_idr','pay_total_price_usd','rmb_total_price','rmb_total_price_idr','rmb_total_price_usd','rc_total_price','rc_total_price_idr','rc_total_price_usd'));
        }

        return redirect()->route('pricing.jobsheet.index');

        // return view('jobsheet.payable.show', compact('jobsheet','references','payables','reimbursements','rcs'));
    }

    public function jobsheet_edit(Request $request, Datatables $datatables, $id)
    {
    	$jobsheet = JobSheet::find($id);
    	$payables   = Payable::where('jobsheet_id', $id)->get();
        $references = Reference::where('jobsheet_id', $id)->get();
        $reimbursements = Reimbursement::where('jobsheet_id', $id)->get();
        $rcs = RC::where('jobsheet_id', $id)->get();

        return view('jobsheet.manager.edit', compact('jobsheet','references','payables','reimbursements','rcs'));
    }

    public function jobsheet_update(Request $request, $id)
    {
        $jobsheet = JobSheet::find($id);
        // $jobsheet->step_role = '2';
        // $jobsheet->save();

        if ($jobsheet)
        {
            //==============UPDATE PAYABLE============
            $payable_id = $request->payable_id;
            $charge     = $request->get('document_id');
            $vendor     = $request->get('vendor_id');
            $unit       = $request->get('unit_id');
            $quanty     = $request->get('quantity');
            $user_id    = $request->get('user_id');
            $currency   = $request->get('currency');
            $price      = $request->get('price');

            for ($j=0; $j < count($charge); $j++)
            {
                if ($payable_id[$j] != 0)
                {
                    $payable = Payable::find($payable_id[$j]);

                    if(!empty($charge[$j]))
                    {
                        $payable->user_id       = $user_id[$j];
                        $payable->jobsheet_id   = $jobsheet->id;
                        $payable->document_id   = $charge[$j];
                        $payable->vendor_id     = $vendor[$j];
                        $payable->unit_id       = $unit[$j];
                        $payable->quantity      = $quanty[$j];
                        $payable->currency      = $currency[$j];

                        $parts=explode(",",$price[$j]);
                        $parts=array_filter($parts);
                        $pay = (implode("",$parts));

                        $payable->price         = $pay;
                        $payable->total         = $pay * $quanty[$j];
                        $payable->save();
                    }else{
                        $payable->delete();
                    }
                } else {
                    if(!empty($charge[$j]) || !empty($vendor[$j]))
                    {
                        $payable = new Payable();
                        $payable->user_id       = Auth::user()->id;
                        $payable->jobsheet_id   = $jobsheet->id;
                        $payable->document_id   = $charge[$j];
                        $payable->vendor_id     = $vendor[$j];
                        $payable->unit_id       = $unit[$j];
                        $payable->quantity      = $quanty[$j];
                        $payable->currency      = $currency[$j];

                        $parts=explode(",",$price[$j]);
                		$parts=array_filter($parts);
                		$pay = (implode("",$parts));

                        $payable->price      	= $pay;
                        $payable->total         = $pay * $quanty[$j];
                        $payable->save();
                    }
                }
            }
            //====UPDATE REIMBURSEMENTS - VENDOR======================

            $rmb_id = $request->rmb_id;
            $vendor_id = $request->rmb_vendor_id;

            for ($i=0; $i < count($rmb_id); $i++)
            {
                if (!empty($vendor_id[$i]))
                {
                    $rmb = Reimbursement::find($rmb_id[$i]);
                    $rmb->rmb_vendor_id = $vendor_id[$i];
                    $rmb->save();
                }
            }

            // =====INPUT & EDIT RC======================================
            $rcs = RC::where('jobsheet_id', $jobsheet->id)->get();

            $rc_id          = $request->rc_id;
            $rc_type        = $request->rc_type;
            $rc_document_id = $request->rc_document_id;
            $rc_vendor_id   = $request->rc_vendor_id;
            $rc_quantity    = $request->rc_quantity;
            $rc_unit_id     = $request->rc_unit_id;
            $rc_currency    = $request->rc_currency;

            for ($a=0; $a < count($rc_document_id); $a++)
            {
                if ($rc_id[$a] != 0)
                {
                    $rc = RC::find($rc_id[$a]);
                    $rcparts=explode(",",$request->rc_price[$a]);
                    $rcparts=array_filter($rcparts);
                    $rc_price = (implode("",$rcparts));

                    if (!empty($rc_document_id[$a]))
                    {
                        $rc->jobsheet_id      = $jobsheet->id;
                        $rc->rc_document_id   = $rc_document_id[$a];
                        $rc->rc_vendor_id     = $rc_vendor_id[$a];
                        $rc->rc_unit_id       = $rc_unit_id[$a];
                        $rc->rc_quantity      = $rc_quantity[$a];
                        $rc->rc_currency      = $rc_currency[$a];
                        $rc->rc_price         = $rc_price;
                        $rc->rc_total         = $rc_price * $rc_quantity[$a];
                        $rc->rc_type          = $rc_type[$a];
                        $rc->save();
                    }else{
                        $rc->delete();
                    }
                } else {
                    if (!empty($rc_document_id[$a]))
                    {
                        $rcparts=explode(",",$request->rc_price[$a]);
                        $rcparts=array_filter($rcparts);
                        $rc_price = (implode("",$rcparts));

                        RC::create([
                            'jobsheet_id'      => $jobsheet->id,
                            'rc_document_id'   => $rc_document_id[$a],
                            'rc_vendor_id'     => $rc_vendor_id[$a],
                            'rc_unit_id'       => $rc_unit_id[$a],
                            'rc_quantity'      => $rc_quantity[$a],
                            'rc_currency'      => $rc_currency[$a],
                            'rc_price'         => $rc_price,
                            'rc_total'         => $rc_price * $rc_quantity[$a],
                            'rc_type'          => $rc_type[$a],
                        ]);
                    }
                }
            }


            // $cekrevisi = Revision::where('jobsheet_id', $jobsheet->id)->where('role', 'pricing')->count();
            // if($cekrevisi > 0) {
            // 	$cekrevisi->delete();
            // }
        }

        return redirect()->route('manager.jobsheet.index');
    }

    public function jobsheet_decline(Request $request, Datatables $datatables)
    {
        $this->validate($request, [
            'note' => 'required_with:receiver'
        ]);

        $jobsheet_id    = $request->jobsheet_id;
        $sender_id      = $request->sender_id;
        $note           = $request->note;
        $receiver       = $request->receiver;
        $receiver_role  = User::find($receiver);

        Revision::create([
            'jobsheet_id'   => $jobsheet_id,
            'sender'        => $sender_id,
            'receiver'      => $receiver,
            'note'          => $note,
            'role'          => $receiver_role->role
        ]);

        $jobsheet = JobSheet::find($jobsheet_id);
        $sender = User::find($sender_id);
        $jobsheet->status = 'revisi-'.$sender->role;
        $jobsheet->save();

        return redirect()->route('manager.index');
    }
}
