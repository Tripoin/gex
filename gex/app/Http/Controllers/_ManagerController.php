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
}
