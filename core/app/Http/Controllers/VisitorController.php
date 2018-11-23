<?php

namespace App\Http\Controllers;

use Auth;
use App\Key;
use App\Team;
use App\User;
use App\Round;
use App\Slider;
use App\Wallet;
use App\Deposit;
use App\Gateway;
use App\General;
use App\Frontend;
use App\Password;
use App\Withdraw;
use Carbon\Carbon;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('language');
    }
    
    public function index()
    {  
        $front = Frontend::first();
        $sliders = Slider::all();
        $round = Round::where('status',0)->first();
        if(isset($round))
        {
            $total = Key::where('round_id', $round->id)->sum('price');
            $teams = Team::where('status', 1)->get();
            $latestkyes = Key::where('round_id', $round->id)->orderBy('id','DESC')->take(10)->get();
            $last = Key::where('round_id', $round->id)->orderBy('id','DESC')->first();

            if(isset($last))
            {
                $price = $last->price + $last->price*$round->inc_rate/100;
                $keyamount = Key::where('round_id', $round->id)->where('code', $last->code)->count();
                if($round->endin > 6)
                {
                    $totalTime = 30*$keyamount;
                    $endtime = Carbon::parse($last->created_at)->addSeconds($totalTime);
                }
                else
                {
                    $totalTime = 15*$keyamount;
                    $endtime = Carbon::parse($last->created_at)->addSeconds($totalTime);
                }
            }
            else
            {
                $price = $round->base_price;
                $endtime = Carbon::now()->addHours($round->endin);
            }
            $gate = Gateway::first();
            
            if(Auth::check())
            {
                $mykey = Key::where('round_id', $round->id)->where('user_id',Auth::id())->sum('price');
                $refers = User::where('refer', Auth::id())->get();
            }

            $lastWinner = Key::where('status', 3)->orderBy('id','DESC')->first();
            if(isset($lastWinner))
            {
                $lastWinAmount = ($lastWinner->round->winner*$lastWinner->price/100) + $lastWinner->price;
            }
            $now = Carbon::now();
            $diff = $endtime->timestamp - $now->timestamp;
            $distance = $diff*1000; 
                
            return view('welcome', compact('front','lastWinAmount','distance','round','price','total','sliders','lastWinner','last','teams','gate','mykey','latestkyes','refers'));
        }
        else
        {
            return view('noround', compact('front'));
        }
       
        
        
    }
    
    public function language($lang)
    {
        session()->put('CurrentLanguage',$lang);
        return back();        
    }
    public function register($refer)
    {
        $reference = User::where('username', $refer)->first();
        
        if(isset($reference))
        {
            return view('auth.register',compact('reference'));
        }
        else
        {
            return view('auth.register');
        }
        
    }

    public function contacMessage(Request $request)
    {
        $gnl = General::first();

        $to = $gnl->email;
        $from = $request->email;
        $name =  $request->name;
        $subject = 'Email From Contact';
        $message = $request->message;
       if(is_null($from))
        {
            return 401;
        }
        else if(is_null($name))
        {
            return 402;
        }
        else if(is_null($message))
        {
            return 403;
        }
        else
        {
            $headers = "From: $gnl->title <$from> \r\n";
            $headers .= "Reply-To: $gnl->title <$from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
            mail($to, $subject, $message, $headers);

           return 200;
        }
        
    }
    
    
    public function verification()
    {
        if(Auth::user()->status == '1' && Auth::user()->emailv == 1 && Auth::user()->smsv == 1)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('auth.verify');
        }
    }
    
    public function sendVcode(Request $request)
    {
        $user = User::find(Auth::id());
        $chktm = $user->vsent+1000;
        if ($chktm > time())
        {
            $delay = $chktm-time();
            return back()->with('alert', 'Please Try after '.$delay.' Seconds');
        }
        else
        {
            $email = $request->email;
            $mobile = $request->mobile;
            $code = str_random(8);
            $msg = 'Your Verification code is: '.$code;
            $user['vercode'] = $code ;
            $user['vsent'] = time();
            $user->update();
            
            if(isset($email))
            {
                send_email($user->email, $user->username, 'Verification Code', $msg);
                return back()->with('success', 'Email verification code sent succesfully');
            }
            elseif(isset($mobile))
            {
                send_sms($user->mobile, $msg);
                return back()->with('success', 'SMS verification code sent succesfully');
            }
            else
            {
                return back()->with('alert', 'Sending Failed');
            }
            
        }
        
    }
    
    public function emailVerify(Request $request)
    {
        $this->validate($request, [ 'code' => 'required' ]);
        $user = User::find(Auth::id());
        $code = $request->code;
        
        if ($user->vercode == $code)
        {
            $user['emailv'] = 1;
            $user['vercode'] = str_random(10);
            $user['vsent'] = 0;
            $user->save();
            
            return redirect()->route('home')->with('success', 'Email Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }
        
    }
    
    public function smsVerify(Request $request)
    {
        $this->validate($request, ['code' => 'required']);
        $user = User::find(Auth::id());
        $code = $request->code;
        
        if ($user->vercode == $code)
        {
            $user['smsv'] = 1;
            $user['vercode'] = str_random(10);
            $user['vsent'] = 0;
            $user->save();
            
            return redirect()->route('home')->with('success', 'Mobile Number Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }
        
    }    
    public function resetEmail()
    {
        return view('auth.passwords.email');
    }
    
    public function sendEmail(Request $request)
    {
        $this->validate($request, ['email'   => 'required']);
        
        $efind = User::where('email', $request->email)->first();
        
        if(isset($efind))
        {
            $code = str_random(32);
            $pass['email'] = $request->email;
            $pass['token'] = $code;
            $pass['status'] = 0;
            Password::create($pass);
            
            $to = $request->email;
            $name = 'User';
            $subject = 'Reset Password';
            $message = 'Use This Link to Reset Password: '.url('/').'/'.'password-reset'.'/'.$code;
            
            send_email($to, $name, $subject, $message);
            
            return back()->withSuccess('Mail Sent Successfuly');
        }
        else
        {
            return back()->withAlert('Invalid Email Address');
        }
        
        
    }
    
    public function resetForm($token)
    {
        $now = Carbon::now();
        $tval = Password::where('token', $token)->where('status',0)->where('created_at', '>', $now->subMinutes(30))->first();
        
        if(isset($tval))
        {   
            $user = User::where('email', $tval->email)->first();
            $username = $user->username;
            return view('auth.passwords.reset', compact('username','token'));
        }
        else
        {
            return redirect()->route('login')->withAlert('Invalid Token');;
        }
        
    }
    
    public function resetPassword(Request $request)
    {
        $this->validate($request,['token' => 'required','password' => 'required','password_confirmation' => 'required',]);
        $now = Carbon::now();
        $reset = Password::where('token', $request->token)->where('status',0)->where('created_at', '>', $now->subMinutes(30))->first();
        if(isset($reset)) 
        {
            $user = User::where('email', $reset->email)->first();
            
            if($request->password == $request->password_confirmation)
            {
                $user['password'] = Hash::make($request->password);
                $user->update();
                
                $reset['status'] = 1;
                $reset->update();
                
                $msg =  'Password Changed Successfully';
                send_email($user->email, $user->username, 'Password Changed', $msg);
                $sms =  'Password Changed Successfully';
                send_sms($user->mobile, $sms);
                
                return redirect()->route('login')->with('success', 'Password Changed');
            }
            else 
            {
                return back()->with('alert', 'Password Not Matched');
            }
            
        }
        else
        {
            return redirect()->route('login')->with('alert', 'Invalid Reset Link');
        }
    }

    public function endRound()
    {
        $round = Round::where('status',0)->first();
        $last = Key::where('round_id', $round->id)->where('status', 1)->orderBy('id','DESC')->first();
        if(isset($last))
        {
            $now = Carbon::now();
            $endtime = $last->created_at->addHours($round->endin);
            if($now>$endtime)
            {
                $round['status'] = 1;
                $round->update();
    
                $total = Key::where('round_id', $round->id)->sum('price');
                
                $winamount = ($last->price*$round->winner)/100;
    
                $winner = User::find($last->user_id);
                $winner['balance'] = $winner->balance + $winamount;
                $winner->update();
    
                $last['status'] = 3;
                $last->update();
    
                $tlog['user_id'] = $winner->id;
                $tlog['amount'] =  $winamount;
                $tlog['balance'] = $winner->balance;
                $tlog['type'] = 1;
                $tlog['details'] = 'Winner of '. $round->name ;
                $tlog['trxid'] = str_random(16);
                Transaction::create($tlog);
    
                $roundkeys = Key::where('round_id', $round->id)->where('status', 1)->get();
                foreach($roundkeys as $k)
                {
                    $team = Team::find($k->team_id);
                    $bonus = ($k->price*$team->amount)/100;
    
                    $member = User::find($k->user_id);
                    $member['balance'] = $member->balance + $bonus;
                    $member->update();
    
                    $k['status'] = 2;
                    $k->update();
    
                    $tlog['user_id'] = $member->id;
                    $tlog['amount'] =  $bonus;
                    $tlog['balance'] = $member->balance;
                    $tlog['type'] = 1;
                    $tlog['details'] = 'Team Bonus of '. $round->name ;
                    $tlog['trxid'] = str_random(16);
                    Transaction::create($tlog);
                }

                $msg =  'You are the winner of round '.$riund->name;
                send_email($winner->email, $winner->username, 'Winner', $msg);
                send_sms($winner->mobile, $msg);

                return 111;
            }
        }
    }
}
        

    