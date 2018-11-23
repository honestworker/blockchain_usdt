<?php

namespace App\Http\Controllers;

use Auth;
use App\Key;
use App\Team;
use App\User;
use App\Admin;
use App\Round;
use App\Deposit;
use App\Gateway;
use App\General;
use App\Wmethod;
use App\Withdraw;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
            
    public function dashboard()
    {
        $users = User::where('status',1)->count();
        $withdraw = Withdraw::where('status',0)->count();
        $deposit = Deposit::where('status',1)->sum('amount');
        $round = Round::where('status',0)->select('id')->first();
        if(isset($round))
        {
            $keys = Key::where('round_id',$round->id)->sum('price');
        }
        $teams = Team::where('status',1)->get();
        $pt = 'DASHBOARD';
        return view('admin.dashboard', compact('users','withdraw','deposit','pt','round','teams','keys'));
    }

    public function keys()
    {
        $keys = Key::orderBY('id','DESC')->paginate('25');
        $pt = 'KEYS';
        return view('admin.users.keys', compact('keys','pt'));
    }
    public function transactions()
    {
        $transactions = Transaction::orderBY('id','DESC')->paginate('25');
        $pt = 'Transactions';
        return view('admin.users.transactions', compact('transactions','pt'));
    }
        
        
    public function general()
    {
        $general = General::first();
        $pt = 'GENERAL SETTINGS';
        
        return view('admin.website.general', compact('general','pt'));
    }
        
    public function generalUpdate(Request $request)
    {
        $general = General::first();
        
        $this->validate($request,
        [
            'title' => 'required',
            'subtitle' => 'required',
            'color' => 'required',
            'cur' => 'required',
            'decimal' => 'required',
            ]);
        
        $general['title'] = $request->title;
        $general['subtitle'] = $request->subtitle;
        $general['color'] = ltrim($request->color,'#');
        $general['cur'] = $request->cur;
        $general['cursym'] = $request->cursym;
        $general['decimal'] = $request->decimal;
        $general['referal'] = $request->referal;
        $general['reg'] = $request->reg ==1 ?1:0;
        $general['emailver'] = $request->emailver ==1 ?0:1;
        $general['smsver'] = $request->smsver ==1 ?0:1;
        $general['emailnotf'] = $request->emailnotf==1 ?1:0;
        $general['smsnotf'] = $request->smsnotf==1 ?1:0;
        $general->update();
        
        return back()->with('success', 'General Settings Updated Successfully!');
    }
        
        
    public function logoIcon()
    {
        $pt = 'LOGO & ICON SETTINGS';
        return view('admin.website.logo',compact('pt'));
    }
        
    public function logoUpdate(Request $request)
    {
        $this->validate($request, 
        [
            'logo' => 'image|mimes:jpeg,png,jpg|max:4048',
            'icon' => 'image|mimes:jpeg,png,jpg|max:4048',         
            'bread' => 'image|mimes:jpeg,png,jpg|max:8048',         
        ]);
            
        if($request->hasFile('logo'))
        {
            Image::make($request->logo)->save('assets/images/logo/logo.png');
        }
        if($request->hasFile('icon'))
        {
            Image::make($request->icon)->resize(128, 128)->save('assets/images/logo/icon.png');
        }
        if($request->hasFile('bread'))
        {
            Image::make($request->bread)->resize(1000, 400)->save('assets/images/logo/bc.jpg');
        }
        
        return back()->with('success','Logo and Icon, Breadcrumb Updated successfully.');
    }
            
    public function emailSms()
    {
        $temp = General::first();
        $pt = 'TEMPLATE SETTINGS';
        return view('admin.website.template', compact('temp','pt'));
    }
                
    public function emailUpdate(Request $request)
    {
        $temp = General::first();
        
        $this->validate($request,['email' => 'email']);
            
        $temp['email'] = $request->email;
        $temp['template'] = $request->template;
        $temp['smsapi'] = $request->smsapi;
        $temp->save();
            
        return back()->with('success', 'Email and SMS Settings Updated Successfully!');
    }
                    
    public function userIndex()
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        $pt = 'USER LIST';
        return view('admin.users.index', compact('users','pt'));
    } 
    
    public function userSearch(Request $request)
    {
        $this->validate($request, [ 'search' => 'required' ]);
        
        $users = User::where('username', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%')->orWhere('name', 'like', '%' . $request->search . '%')->get();
        $key = $request->search;
        $pt = 'USER SEARCH RESULT';
        return view('admin.users.search', compact('users','key','pt'));
        
    }
    
    public function singleUser($id)
    {
        $user = User::findOrFail($id);
        $pt = $user->name;
        return view('admin.users.single', compact('user','pt'));
    }
       
    public function email($id)
    {
        $user = User::findorFail($id);
        $pt = 'SEND EMAIL';
        return view('admin.users.email',compact('user','pt'));
    }
                        
    public function sendemail(Request $request)
    {
        $this->validate($request,
        [   'emailto' => 'required|email',
            'reciver' => 'required',
            'subject' => 'required',
            'emailMessage' => 'required'
            ]);
        $to = $request->emailto;
        $name = $request->reciver;
        $subject = $request->subject;
        $message = $request->emailMessage;
        
        send_email($to, $name, $subject, $message);
        
        return back()->withSuccess('Mail Sent Successfuly');
            
    }
        
    public function broadcast()
    {   
        $pt = 'BROADCAST EMAIL';
        return view('admin.users.broadcast',compact('pt'));
    }
                            
    public function broadcastemail(Request $request)
    {
        $this->validate($request,[ 'subject' => 'required','emailMessage' => 'required']);
    
        $users = User::where('status', '1')->get();
        
        foreach ($users as $user)
        {
            
            $to = $user->email;
            $name = $user->name;
            $subject = $request->subject;
            $message = $request->emailMessage;
            
            send_email($to, $name, $subject, $message);
        }
    
        return back()->withSuccess('Mail Sent Successfuly');
    }
                                
    public function userPasschange(Request $request,$id)
    {
        $user = User::find($id);
        
        $this->validate($request,['password' => 'required|string|min:6|confirmed']);
        if($request->password == $request->password_confirmation)
        {
            $user->password = Hash::make($request->password);
            $user->save();
            
            $msg =  'Password Changed By Admin. New Password is: '.$request->password;
            send_email($user->email, $user->username, 'Password Changed', $msg);
            $sms =  'Password Changed By Admin. New Password is: '.$request->password;
            send_sms($user->mobile, $sms);
            
            return back()->with('success', 'Password Changed');
        }
        else 
        {
            return back()->with('alert', 'Password Not Matched');
        }
    }

    public function statupdate(Request $request,$id)
    {
        $user = User::find($id);
        
        $this->validate($request,
        [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'mobile' => 'required|string|max:255',
        ]);
            
        $user['name'] = $request->name ;
        $user['mobile'] = $request->mobile;
        $user['email'] = $request->email;
        $user['status'] = $request->status =="1" ?1:0;
        $user['emailv'] = $request->emailv =="1" ?1:0;
        $user['smsv'] = $request->smsv =="1" ?1:0;
        $user['tauth'] = $request->tauth =="1" ?1:0;
        
        $user->save();
        
        $msg =  'Your Profile Updated by Admin';
        send_email($user->email, $user->username, 'Profile Updated', $msg);
        $sms =  'Your Profile Updated by Admin';
        send_sms($user->mobile, $sms);
        
        return back()->withSuccess('User Profile Updated Successfuly');
    }
        
    public function bannedUser()
    {
        $users = User::where('status', '0')->orderBy('id', 'desc')->paginate(10);
        $pt = 'BANNED USERS';
        return view('admin.users.banned', compact('users','pt'));
    }
        
    public function gateway()
    {
        $gateway = Gateway::first();
        $pt = 'PAYMENT GATEWAY';
        return view('admin.website.gateway', compact('gateway','pt'));
    }
           
    public function gatewayUpdate(Request $request)
    {
        $this->validate($request, ['gateimg' => 'image|mimes:jpeg,png,jpg|max:2048','name' => 'required']);
        $gateway = Gateway::first();
        
        if($request->hasFile('gateimg'))
        {
            $imgname = $gateway->id.'.jpg';
            $npath = 'assets/images/gateway/'.$imgname;
            Image::make($request->gateimg)->resize(200, 200)->save($npath);
        }
        
        $gateway['name'] = $request->name;
        $gateway['minamo'] = $request->minamo;
        $gateway['maxamo'] = $request->maxamo;
        $gateway['fixed_charge'] = $request->fixed_charge;
        $gateway['percent_charge'] = $request->percent_charge;
        $gateway['rate'] = $request->rate;
        $gateway['val1'] = $request->val1;
        $gateway['val2'] = $request->val2;
        $gateway['status'] = $request->status;
        $gateway->update();
        
        return back()->with('success','Gateway Information Updated Successfully');
    }

    public function wmethod()
    {
        $gateways = Wmethod::all();
        $pt = 'WITHDRAW METHOD';
        return view('admin.website.wmethod', compact('gateways','pt'));
    }
           
    public function wmethodCreate(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        
        $wmethod['name'] = $request->name;
        $wmethod['minamo'] = $request->minamo;
        $wmethod['maxamo'] = $request->maxamo;
        $wmethod['fixed_charge'] = $request->fixed_charge;
        $wmethod['percent_charge'] = $request->percent_charge;
        $wmethod['rate'] = $request->rate;
        $wmethod['val1'] = $request->val1;
        $wmethod['status'] = $request->status;
        Wmethod::create($wmethod);
        
        return back()->with('success','Withdraw Method Created Successfully');
    }

    public function wmethodUpdate(Request $request, Wmethod $wmethod)
    {
        $this->validate($request,  ['name' => 'required']);
        
        $wmethod['name'] = $request->name;
        $wmethod['minamo'] = $request->minamo;
        $wmethod['maxamo'] = $request->maxamo;
        $wmethod['fixed_charge'] = $request->fixed_charge;
        $wmethod['percent_charge'] = $request->percent_charge;
        $wmethod['rate'] = $request->rate;
        $wmethod['val1'] = $request->val1;
        $wmethod['status'] = $request->status;
        $wmethod->update();
        
        return back()->with('success','Withdraw Method Updated Successfully');
    }
        
    public function deposits()
    {
        $deposits = Deposit::orderBy('id','DESC')->paginate(15);
        $pt = 'DEPOSITS';
        return view('admin.users.drequest', compact('deposits','pt'));
    }
    
    public function depoApprove(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit['status'] = 1;
        $deposit->update();
        
        $user = User::findOrFail($deposit->user_id);
        $user['balance'] = $user->balance + $deposit->amount;
        $user->save();
        
        $tlog['user_id'] = $user->id;
        $tlog['amount'] = $deposit->amount;
        $tlog['balance'] = $user->balance;
        $tlog['type'] = 1;
        $tlog['details'] = 'Deposit via '.$deposit->gateway->name;
        $tlog['trxid'] = str_random(16);
        Transaction::create($tlog);
        
        return back()->with('success','Deposit Approved Successfully');
        
    }
                
    public function depoCancel(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit['status'] = 2;
        $deposit->update();
        
        return back()->with('success','Deposit Canceled Successfully');
        
    }
    
    public function withdrawRequest()
    {
        $reqs = Withdraw::where('status',0)->paginate(20);
        $pt = 'WITHDRAW REQUEST';
        return view('admin.users.withreqs', compact('reqs','pt'));
    }
    public function withdrawLog()
    {
        $logs = Withdraw::where('status',1)->paginate(20);
        $pt = 'WITHDRAW LOG';
        return view('admin.users.withlog', compact('logs','pt'));
    }
    public function withdrawApprove(Request $request, $id)
    {
        $withd = Withdraw::findOrFail($id);
        $withd['status'] = 1;
        $withd->update();
        
        return back()->with('success','Withdraw Approved Successfully');
    }
    public function withdrawCancel(Request $request, $id)
    {
        $withd = Withdraw::findOrFail($id);
        $withd['status'] = 2;
        $withd->update();
        
        $user = User::find(Auth::id());
        $user['balance'] = $user->balance + $withd->amount;
        $user->update();
        
        
        $tlog['user_id'] = $user->id;
        $tlog['amount'] = $withd->amount;
        $tlog['balance'] = $user->balance;
        $tlog['type'] = 1;
        $tlog['details'] = 'Withdraw Canceled';
        $tlog['trxid'] = str_random(16);
        Transaction::create($tlog);
        
        return back()->with('success','Withdraw Canceled Successfully');
    }
                
    public function changePassword()
    {
        $pt = 'CHANGE PASSWORD';
        return view('admin.auth.changepass',compact('pt'));
    }
    
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        if(Hash::check($request->passwordold, $admin->password) && $request->password == $request->password_confirmation)
        {
            $admin['password'] =  Hash::make($request->password);
            $admin->save();
            return back()->with('success', 'Password Changed');
        }
        else 
        {
            return back()->with('alert', 'Password Not Changed');
        }
    }
    public function newAdmin()
    {
        $pt = 'NEW ADMIN REGISTRATION';
        return view('admin.auth.newadmin',compact('pt'));
    }
                
    public function listAdmin()
    {
        $admins = Admin::all();
        $pt = 'ADMIN LIST';
        return view('admin.auth.adminlist', compact('admins','pt'));
    }
                
    public function createAdmin(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:admins',
            'username' => 'required|string|max:191|unique:admins|alpha_dash',
            'password' => 'required|string|min:5|confirmed',
        ]);
        
        $admin['name'] = $request->name;
        $admin['email'] = $request->email;
        $admin['username'] = $request->username;
        $admin['password'] = Hash::make($request->password);
        Admin::create($admin);
        
        return back()->with('success', 'New Admin Created Successfully');
            
    }        
    
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
        'username'   => 'required',
        'password' => 'required'
        ]);
            
        if (Auth::guard('admin')->attempt(['username' => $request->username, 
        'password' => $request->password])) 
        {
            return redirect()->intended(route('admin.dashboard'));
        } 
        return redirect()->back()->with('alert','Username and Password Not Matched');
    }
        
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->intended(route('admin.login'));
    }

}
                                                