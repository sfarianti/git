<!-- ?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// class EmailController extends Controller
// {
//      /**
//      * Write code on Method
//      *
//      * @return response()
//      */
//     public function index()
//     {
//         return view('emails.email_approval');
//     }
  
//     /**
//      * Write code on Method
//      *
//      * @return response()
//      */
//     public function store(Request $request)
//     {
//         require base_path("vendor/autoload.php");
//         $mail = new PHPMailer(true);
   
//         try {
//             /* Email SMTP Settings */
//             $mail->SMTPDebug = 2;
//             $mail->isSMTP();
//             $mail->Host = "sandbox.smtp.mailtrap.io";
//             $mail->SMTPAuth = true;
//             $mail->Username = "2ef5d00c70d4ee";
//             $mail->Password = "693d6d89665e6a";
//             $mail->SMTPSecure = "tls";
//             $mail->Port = 2525;
   
//             $mail->setFrom("renataverina@gmail.com", "Laravel");
//             $mail->addAddress($request->email);
   
//             $mail->isHTML(true);
//             $mail->Subject = $request->subject;
//             $mail->Body    = $request->body;
   
//             if( !$mail->send() ) {
//                 return back()->with("error", "Email not sent.")->withErrors($mail->ErrorInfo);
//             }
              
//             else {
//                 return back()->with("success", "Email has been sent.");
//             }
   
//         } catch (Exception $e) {
//              return back()->with('error','Message could not be sent.');
//         }
//     }
// } 
