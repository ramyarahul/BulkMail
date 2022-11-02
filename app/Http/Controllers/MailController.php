<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendBulkMailJob;

class MailController extends Controller
{
    public function mail(){
        $list_mails=Email::orderBy('id','desc')->paginate(5);
        return view('mail',compact('list_mails'));
    }
    public function CreateMail(){
        return view('create');
    }
    public function StoreMail(Request $request){   
        $input['email'] =$request->email;
        $rules = array('email' => 'unique:emails,email');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect("mail")->withSuccess('That email address is already registered');
        }
        else {
            $check = Email::create([
                'email'=>$request->email,
                'email_verified_at' => date('Y-m-d'),
            ]);     
            return redirect("mail")->withSuccess('E-mail added succesfully');
        }                
    }
    public function DestroyMail($mail_id){
        Email::destroy(decrypt($mail_id));
        return redirect()->route("mail")->withSuccess("Mail deleted Successfully");
    }
    public function Content(){
       return view('emails.content');
    }
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
    public function ContentSend(Request $request){
        $data = $request->all();
        $mails=Email::select('id','email')->get();
        foreach ($mails as $recipient) {
            SendBulkMailJob::dispatch($data,$recipient->email);
        }
        return redirect()->route("content")->withSuccess("Mail sent Successfully");

    }
}
?>