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
use App\Transaction;
use Illuminate\Http\Request;
use App\Lib\CoinPaymentHosted;

class PaymentController extends Controller
{    
    public function depositConfirm(Request $request)
    {  
        if(0 >= $request->input('amount') || $request->input('amount') == '' )
        {
            return 99;            
        }
        else if(is_null($request->input('team')))
        {
            return 77;            
        }
        else
        {
            $method = Gateway::first();
            $round = Round::where('status',0)->first();
            $team = Team::findOrFail($request->input('team'));
            $last = Key::where('round_id', $round->id)->orderBy('id','DESC')->select('price')->first();
            if(isset($last))
            {
                $price = $last->price + $last->price*$round->inc_rate/100;
            }
            else
            {
                $price = $round->base_price;
            }
            $amount = round($request->input('amount')*$price,8);
        
            $usdamo =  round($amount/$method->rate,2);
            $track = str_random(16);
            $cps = new CoinPaymentHosted();
            $cps->Setup($method->val2,$method->val1);
            $callbackUrl = route('ipn.coinPay');
            
            $req = array(
                'amount' =>  $usdamo,
                'currency1' => 'USD',
                'currency2' => $method->status,
                'custom' => $track,
                'ipn_url' => $callbackUrl,
            );
            
            $result = $cps->CreateTransaction($req);
            
            if ($result['error'] == 'ok') 
            {
                $bcoin = sprintf('%.08f', $result['result']['amount']);
                $sendadd = $result['result']['address'];
            
                $depo['user_id'] = Auth::id();
                $depo['gateway_id'] = $method->id;
                $depo['amount'] = $amount;
                $depo['charge'] = 0;
                $depo['usd_amo'] = round($usdamo,2);
                $depo['btc_amo'] = $bcoin;
                $depo['btc_wallet'] = $sendadd;
                $depo['trx'] = $track;
                $depo['round_id'] = $round->id;
                $depo['team_id'] = $team->id;
                $depo['status'] = 0;
                Deposit::create($depo);

                $data['status'] = 11;
                $data['wallet'] = $sendadd;
                $data['amount'] = $amount;
                return  $data;
            } 
            else 
            {
               return 88;
            }
            
        }
    
    }
    
    
    //IPN Function //     
    
    public function ipnCoinPay(Request $request)
    {
        $track = $request->custom;
        $status = $request->status;
        $amount2 = floatval($request->amount,2);
        $currency2 = $request->currency2;
        $method = Gateway::first();
        $data = Deposit::where('trx',$track)->orderBy('id', 'DESC')->first();
        $bcoin = $data->btc_amo;
        if($status>=100 || $status==2) 
        {
            if ($currency2 ==  $method->status && $data->status == '0' && $data->btc_amo<=$amount2) 
            {
                $data['status'] = 1;
                $data->update();

                $last = Key::where('round_id', $data->round_id)->orderBy('id','DESC')->select('price')->first();
                if(isset($last))
                {
                    $price = $last->price + ($last->price*$data->round->inc_rate)/100;
                }
                else
                {
                    $price = $data->round->base_price;
                }

                $ks = intval($data->amount/$price);

                for($i = 0; $i < $ks; $i++)
                {
                    $key['user_id'] = $data->user_id;
                    $key['round_id'] = $data->round_id;
                    $key['team_id'] = $data->team_id;
                    $key['price'] = $price;
                    $key['type'] = 2;
                    $key['code'] = str_random(12);
                    $key['status'] = 1;
                    Key::create($key);
                }

                if($data->user->refer!=0) 
                {
                    $gnl = General::first();
                    $commision = ($data->amount*$gnl->referal)/100;
               
                    $refer = User::find($data->user->refer);
                    $refer['balance'] = $refer->balance + $commision;
                    $refer->update();

                    $tlog['user_id'] = $refer->id;
                    $tlog['amount'] =  $commision;
                    $tlog['balance'] = $refer->balance;
                    $tlog['type'] = 1;
                    $tlog['details'] = 'Referal Commision of from '. $data->user->name ;
                    $tlog['trxid'] = str_random(16);
                    Transaction::create($tlog);
    
                    $msg =  'Referal Commision of from '. $data->user->name ;
                    send_email($refer->email, $refer->username, 'Referal Commision', $msg);
                    send_sms($refer->mobile, $msg);
                } 
                
                $msg =  'Key Purchased Successfully';
                send_email($data->user->email, $data->user->username, 'Purchase Successfull', $msg);
                send_sms($data->user->mobile, $msg);
            }
        }
    }
    
}	
