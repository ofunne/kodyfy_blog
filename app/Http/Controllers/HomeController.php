<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Invoice;
use App\User;
use App\Subscription;
use App\SubscriptionDetail;
use Validator;
use DB;
use Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('welcome', compact('posts'));
    }

    public function show(Post $post)
    {
        if(!Auth::guest())
        {
            dd('i am logged in');
        } else{
            
            dd('i am just a guest');
        }
    }

    public function comment_save(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        //Create Comment
        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->input('hidden_id');
        $comment->comment = $request->input('comment');
        $comment->comment_status = 'active';
        $comment->save();

        return redirect()->back()->with('success', 'Comment Created');
    }

    public function dashboard()
    {
        return view('home');
    }

    public function upload_invoice(Request $request)
    {
        $this->validate($request, [
            'payment_invoice' => 'required|image|max:1999'
        ]);

        //Handle file upload
        // Get filename with the extension
        $filenameWithExt = $request->file('payment_invoice')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('payment_invoice')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('payment_invoice')->storeAs('public/invoices', $fileNameToStore);
        
        $var = 'ba';
        $name = Str::kebab(auth()->user()->name);
        $ticket = $var.'_'.$name.'_'.time();

        //Create Invoice
        $invoice = new Invoice;
        $invoice->invoice_file = $fileNameToStore;
        $invoice->user_id = auth()->user()->id;
        $invoice->invoice_status = 'unverified';
        $invoice->invoice_ticket = $ticket;
        $invoice->save();

        return redirect()->back()->with('success', 'File Uploaded, you will get a mail once verified.');
    }


    public function adminHome()
    {
        $eID = auth()->user()->id;
        $posts = Post::whereUserId($eID)->orderBy('id', 'desc')->get();
        $invoices = Invoice::whereInvoiceStatus('unverified')->get();
        return view('admin.index', compact('posts', 'invoices'));
    }

    public function view_invoice(Invoice $invoice)
    {
        return view('admin.view_invoice', compact('invoice'));
    }

    public function activate_account(Request $request)
    {
        //Activate pending payment from user
        $form_data = array(
            'sub_status'        =>  '1'
        );

        Subscription::whereId($request->hidden_subscription)->update($form_data);

        if(SubscriptionDetail::whereSubscriptionId($request->hidden_subscription)->whereTask('refer')->exists())
        {
            $target = TargetPoint::first();
            $form_data = array(
                'point'        =>  $target->refer_task
            );

            SubscriptionDetail::whereSubscriptionId($request->hidden_subscription)->update($form_data);
        }

        $form_data = array(
            'invoice_status'        =>  'verified'
        );

        Invoice::whereUserId($request->hidden_invoice_id)->update($form_data);

        $form_data = array(
            'payment_status'        =>  '1'
        );

        User::whereId($request->hidden_user_id)->update($form_data);

        return redirect()->back()->with('success', 'Account activated.');
    }

}
