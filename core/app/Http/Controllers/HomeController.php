<?php

namespace App\Http\Controllers;

use Auth;
use App\Key;
use Session;
use App\Team;
use App\User;
use App\Round;
use App\Deposit;
use App\Gateway;
use App\General;
use App\Wmethod;
use App\Frontend;
use App\Withdraw;
use Carbon\Carbon;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    
    public function index()
    {
        return redirect('/');
    }

    public function keys()
    {
        $keys = Key::where('user_id',Auth::id())->orderBy('id', 'DESC')->paginate(15);
        return view('user.keys',compact('keys'));
    }

    public function payments()
    {
        $payments = Deposit::where('user_id',Auth::id())->orderBy('id', 'DESC')->paginate(15);
        return view('user.payments',compact('payments'));
    }

    public function userProfileData()
    {
        $user = User::find(Auth::id());
        return view('user.profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'city' => 'required'
        ]);
        $user = User::find(Auth::id());
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['mobile'] = $request->mobile;
        $user['country'] = $request->country;
        $user['city'] = $request->city;
        $user->update();
        return back()->with('success', 'Profile Data Updated');
    }
    

    public function transactionLog()
    {
        $logs = Transaction::where('user_id',Auth::id())->orderBy('id','DESC')->paginate(10);
        return view('user.tlog', compact('logs'));
    }

    public function purchaseVault(Request $request)
    {
        if(0 >= $request->input('amount') || $request->input('amount') == '' )
        {
            return 99;            
        }
        else if(is_null($request->input('team')))
        {
            return 77;            
        }
                
        $method = Gateway::first();
        $round = Round::where('status',0)->first();
        $last = Key::where('round_id', $round->id)->orderBy('id','DESC')->select('price')->first();

        if(isset($last))
        {
            $price = $last->price + $last->price*$round->inc_rate/100;
        }
        else
        {
            $price = $round->base_price;
        }
        $keyAmount = intval($request->input('amount'));
        $amount = round($keyAmount*$price,8);
        $user = User::find(Auth::id());
        if( $user->balance < $amount)
        {
            return 88;            
        }
        else
        {
            $team = Team::findOrFail($request->input('team'));
            $user['balance'] =  $user->balance - $amount;
            $user->update(); 

            $tlog['user_id'] = $user->id;
            $tlog['amount'] =  $amount;
            $tlog['balance'] = $user->balance;
            $tlog['type'] = 0;
            $tlog['details'] = 'KEY PURCHASED';
            $tlog['trxid'] = str_random(16);
            Transaction::create($tlog);
              
            $round['pot'] = $round->pot + $amount;
            $round->update();
            $code = str_random(12);           
            for($i = 0; $i < $keyAmount; $i++)
            {
                $key['user_id'] = $user->id;
                $key['round_id'] = $round->id;
                $key['team_id'] = $team->id;
                $key['price'] = $price;
                $key['type'] = 1;
                $key['code'] = $code;
                $key['status'] = 1;
                Key::create($key);
            }

            if($user->refer!=0) 
            {
                $gnl = General::first();
                $commision = ($amount*$gnl->referal)/100;
          
                $refer = User::find($user->refer);
                $refer['balance'] = $refer->balance + $commision;
                $refer->update();
                
                $tlog['user_id'] = $refer->id;
                $tlog['amount'] =  $commision;
                $tlog['balance'] = $refer->balance;
                $tlog['type'] = 1;
                $tlog['details'] = 'Referal Commision of from '. $user->name ;
                $tlog['trxid'] = str_random(16);
                Transaction::create($tlog);

                $msg =  'Referal Commision of from '. $user->name ;
                send_email($refer->email, $refer->username, 'Referal Commision', $msg);
                send_sms($refer->mobile, $msg);
            } 
            
            $msg =  'Key Purchased Successfully';
            send_email($user->email, $user->username, 'Purchase Successfull', $msg);
            send_sms($user->mobile, $msg);

            return 11;
        }
    }

    public function withdraw()
    {
        $gates = Wmethod::where('status',1)->get();
        return view('user.withdraw', compact('gates'));
    }

    public function withdrawPost(Request $request)
    {
        $this->validate($request, ['amount' => 'required','account' => 'required','gateway' => 'required']);
        
        $method = Wmethod::findOrFail($request->gateway);

        $charge = $method->fixed_charge + ($request->amount*$method->percent_charge/100);
        $amount = $request->amount + $charge;
        $user = User::find(Auth::id());
        if($request->amount<=0 ||  $amount < $method->minamo ||  $amount > $method->maxamo || $amount > $user->balance)
        {
            return back()->with('alert', 'Invalid Amount');
        }
        else
        {
            $user['balance'] = $user->balance - $amount;
            $user->update();
            
            $with['user_id'] = Auth::id();
            $with['wmethod_id'] = $method->id;
            $with['amount'] = $request->amount;
            $with['account'] = $request->account;
            $with['status'] = 0;
            Withdraw::create($with);
    
            $tlog['user_id'] = $user->id;
            $tlog['amount'] =  $amount;
            $tlog['balance'] = $user->balance;
            $tlog['type'] = 0;
            $tlog['details'] = 'Balance Withdarw via '. $method->name;
            $tlog['trxid'] = str_random(16);
            Transaction::create($tlog);
    
            return back()->with('success', 'Withdraw Request Sent Successfully!');
        }
     
        
    }
    
    public function changePasswordForm()
    {
        return view('user.change');
    }
        
    public function changePassword(Request $request)
    {
        $this->validate($request,
        [
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = User::find(Auth::id());
        if($request->password == $request->password_confirmation)
        {
            $user['password'] = Hash::make($request->password);
            $user->update();

            return back()->with('success', 'Password Changed');
        }
        else 
        {
            return back()->with('alert', 'Password Not Matched');
        }
    }
     
}
    