<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function index( Request $request)
    {
        $data = [];
        if( $request->search!==null && $request->search_sub!==null )
        {

            $keywords = str_replace(' ','+', $request->search );

            $apiURL = 'https://customsearch.googleapis.com/customsearch/v1?cx=229b8e687d43b6440&q='.$keywords.'&key=AIzaSyDwaCY_kpMkXC7ZROPOMJH6gmRD7RfhJy8';
  
            $response = Http::get($apiURL);
            
            $data = json_decode($response);

            Record::insert(['title'=>$request->search,'user_name' =>$request->session()->get('USER_NAME'),'full_respone'=>$response]);
           
        }

       
       
        return view('search' ,['title'=>'Search Here' , 'data'=>$data]);
    }



    public function register_customer(Request $request)
    {
        $rules = [
		 
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            ];

        $customMessages = 
                [
                'required' => 'This Field can not be blank.',
                

                ];

        $this->validate($request, $rules, $customMessages);
        $model = new Customer();
       
		$msg = 'Register Successfully';
        $fields = [
            'name'  => $request->name,
            'email'  => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'phone' => $request->phone,
           
        ];

        Customer::create($fields);
		
	    $request->session()->flash('reg_add_msg',$msg);
		return redirect('register');
    }

    public function login(Request $request)
    {
        echo $request->session()->get('USER_ID');
        if( $request->session()->get('USER_LOGIN') &&  $request->session()->get('USER_ID') )
        {
            return redirect('search');
        }
        return view('login',['title'=>'Login']);
    }

    public function auth_login(Request $request)
    { 
        $email  = $request->post('email');
		$password  = $request->post('password');
		$result = Customer::where(['email' => $email ])->get();
		//echo "<pre>";print_r($result);die;
		if(isset($result[0]->id))
		{
            if( ! password_verify( $password , $result[0]->password) )
            {
                $request->session()->flash('errorMsg' ,'Invalid Password !');
                return redirect('login');
            }

			$request->session()->put('USER_LOGIN' ,true);
			$request->session()->put('USER_ID' ,$result[0]->id);
            $request->session()->put('USER_NAME' ,$result[0]->name);
			return redirect('search');
		}
		else
		{
			$request->session()->flash('errorMsg' ,'Invalid Email !');
			return redirect('login');
		}
		
    }
}
