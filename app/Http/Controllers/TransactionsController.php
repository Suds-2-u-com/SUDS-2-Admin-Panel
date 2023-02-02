<?php
namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Validator;
use App\TransactionsModel;
use App\PayOutTransactionsModel;
use App\BankModel;
use App\PayOutModel;
use App\UserModel;
use Auth;
use DB;
use Stripe;
class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $Transactions;
    private $PayOutTransactions;
    private $Payout;

    public function __construct(TransactionsModel $TransactionsModel,PayOutTransactionsModel $PayOutTransactionsModel,BankModel $BankModel,PayOutModel $PayOutModel)
    {
        $this->Transactions=new UserRepository($TransactionsModel);
        $this->PayOutTransactions=new  UserRepository($PayOutTransactionsModel);
        $this->Bank=new UserRepository($BankModel);
        $this->Payout=new UserRepository($PayOutModel);
       
     
    }
    public function index()
    {
       if(Auth::check()){
        if(Auth::user()->role_as=='1'){
        $data=[
            'transactions'=> $this->Transactions->all('id')
        ];

        return view('booking.transactions')->with($data);
        }else{
           return redirect('Profile');
        }
        }else{
            return redirect('/Admin-Login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function payamount(Request $request, $id)
    {
        $data = $request->except([
            '_token',
          ]);
        $data['status']=1;
       
       // $this->Transactions->updateWithId($data,$id,'id');
        
        $payment=$this->Transactions->where(array('id'=>$id));
       
        if(!empty($payment)){
             $result=$this->Transactions->find($id);
        
            if($result){
               $amount=$result->amount;
               $washer_amt=$result->washer_amt;
               $commmison=$result->commmison;
           
               
              $user=UserModel::where(['id'=>$payment[0]['to_id']])->first();
            
              if(/*!empty($user->wallet_amount)*/$user && $user->washer_accountid !=''){
              $wallet_amount=$user->wallet_amount;//400  //320 washer 80 admn
              
          
          
              $ctotal=($wallet_amount*$result->commmison/100);
              
              $usertotal=$wallet_amount-$ctotal;
              $adc=  ($wallet_amount*$result->admin_comission)/100;

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $stripe = new \Stripe\StripeClient(
            'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
            );

            $response = $stripe->transfers->create([
            'amount' => $washer_amt,
            'currency' => 'usd',
            'destination' => $user->washer_accountid,
            'transfer_group' => 'ORDER_'.$result->to_id,
            ]);
            if($response && $response->id!='') {
              
            UserModel::where(['id'=>$payment[0]['to_id']])->update([
                                                  
                        'wallet_amount' => \DB::raw('wallet_amount -'.$adc)
                        ]); 
                        
                        
            UserModel::where(['id'=>1])->update([
                                                 
                        'wallet_amount' => \DB::raw('wallet_amount +'.$adc)
                        ]);  

            TransactionsModel::where(['id'=>$result->id])->update([    
                        'payout_status' => 1,
                        'payout_time' => date('Y-m-d H:i:s',$response->created),
                        'transfer_id' => $response->id
                        ]);                   
            PayOutTransactionsModel::insert(array('washer_id'=>$result->to_id,'amount'=>$result->washer_amt,'created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')));
            } 
                        
              }else {
                return redirect('Booking-Transactions')->with('error', 'Account not created.');

              }
            }
           $data['washer_id']=$payment[0]['to_id'];
           $data['amount']=$payment[0]['washer_amt'];
           $this->PayOutTransactions->create($data);    
           
        }

        return redirect('Booking-Transactions')->with('success', 'Payment successfully.');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     public function showPayDetails(Request $request){
        $id=$request->input('id');  
        $data=['transactions'=>$this->Transactions->where(array('id'=>$id))]; 
        return view('booking.payout')->with($data);
    }
    
    public function showPayout(Request $request){
        $id=$request->input('id');
        $data=['transactions'=>$this->Transactions->where(array('to_id'=>$id))];
        return view('booking.show_payout')->with($data);
    }
    
    public function showPayoutCreate(Request $request){
        $id=$request->input('id');
        $data=DB::table('users')->where(array('id'=>$id))->first();
        return view('booking.show_payout_create')->with('transactions', $data);
    }
    public function createAccount(Request $request, $id)
    {
        $data = $request->except([
            '_token',
          ]);
        $data['status']=1;
       
       // $this->Transactions->updateWithId($data,$id,'id');
        
        $washer=DB::table('users')->where(array('id'=>$id))->first();
       
        if(!empty($washer)){

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    $stripe = new \Stripe\StripeClient(
                        'sk_test_51HPbfHIIXgbKLxqKHqi70ZJIFV7QEJhBDyMJ9o4t0oltK7MOnpTyKNQBaDNXBOTZ5IwocnoPRiHE7NlwACWXm65g00w6UzeeBB'
                    );
                if($washer->washer_accountid =='') {
                    $accounts = $stripe->accounts->create([
                    'type' => 'custom',
                    'country' => 'US',
                    'email' => $washer->email,
                    'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                    ],
                    //'individual'=> ['phone' => '804-222-1111'], 
                    ]);
                    $account_id = $accounts->id;
                }

                    $accountLinks = $stripe->accountLinks->create([
                    'account' => ($washer->washer_accountid !='') ? $washer->washer_accountid : $account_id,
                    'refresh_url' => 'https://suds-2-u.com/reauth',
                    'return_url' => 'https://suds-2-u.com/return',
                    'type' => 'account_onboarding',
                    ]);

                    DB::table('users')
                    ->where('id', $id)
                    ->update(['washer_accountid'=>($washer->washer_accountid !='') ? $washer->washer_accountid : $account_id,'washer_account_link'=>$accountLinks->url]);
 
           
        }

        return redirect('Washer-List')->with('success', 'Payout Account created successfully.');
       
    }
    
    public function paymentDone(Request $request){
        $id=$request->input('id');
       $this->Transactions->update(array('status'=>1),$id);
        $payment=$this->Transactions->where(array('id'=>$id));
        if(!empty($payment)){
           $data['washer_id']=$payment[0]['to_id'];
           $data['amount']=$payment[0]['washer_amt'];
           $data['created_at']=date('Y-m-d');
           $data['updated_at']=date('Y-m-d');
           $this->PayOutTransactions->create($data);
        }
        echo json_encode(array('response'=>true));
    }
    
    public function payOutTransaction(){
        if(Auth::check()){
        if(Auth::user()->role_as=='1'){ 
        $data=[
            'transactions'=> $this->PayOutTransactions->all('id')
        ];

        return view('booking.payouttransactions')->with($data);
        }else{
            return redirect('Profile'); 
        }
        }else{
            return redirect('/');
        }
    }
    
    public function showPayoutTransaction(Request $request){
        $id=$request->input('id');
        $user_id=$request->input('user_id');
        $data=['bank'=>$this->Bank->get_first_record($user_id,'user_id'),'payment'=>$this->Payout->get_first_record($id,'payment_id'),'id'=>$id,'user_id'=>$user_id];
        return view('booking.payout_transaction')->with($data);    
    }
    
    public function addPayout(Request $request){
         $validator = Validator::make($request->all(), [
            'bank_account' => 'required',
            'transaction_id' => 'required',
            'transaction_time'=>'required',
            'transaction_amount'=>'required',
            'transaction_date'=>'required',
            'user_id'=>'required',
            'payment_id'=>'required',
        ]);
        if ($validator->passes()) {

        	 $data = $request->except([
            '_token',
          ]);
         
        if($this->Payout->create($data)){
               return response()->json(['success'=>'Added Payout Detailas.','response'=>true]);
        }else{
               return response()->json(['success'=>'Something went wrong','response'=>false]);
        }
       
     }
      return response()->json(['error'=>$validator->errors()]);
    }

}
