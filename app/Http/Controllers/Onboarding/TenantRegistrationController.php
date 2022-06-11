<?php

namespace App\Http\Controllers\Onboarding;

// use App\Cpanel\CPANEL;
use Cpanel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Onboarding\RegisterTenantRequest;
use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class TenantRegistrationController extends Controller
{
    //

    public function showForm(Request $request){

      
        return view('onboarding.register-account');
    }
    public function processForm(RegisterTenantRequest $request){ 
        $data= $request->validated();
       
        //Create Tenant ! *
        $tenant =Tenant::create(['phone_number'=>$request->phone,'email'=>$request->email,'valid_until'=>Carbon::now()->addDays(30)]);
        $subdomain =$tenant->domains()->create(['domain'=>$request->subdomain ,'domain_type'=>'subdomain']);
        $tenant->run(function() use($request) {
           $user= User::create([
            'name'=>$request->name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password)] );         
           $user->roles()->sync(1);
        });

         return redirect()->route('tenant.home')->domain($subdomain);
        // return Redirect::to("http://{$request->subdomain}.{$request->getHttpHost()}");
        
        



    }
    public function checkDomain (Request $request , String $domain){

        $domains =Domain::where('domain',$domain)->get();
        
        return response()->json(['domainExist'=>$domains->count()>0 ? true : false]);

    }
}
