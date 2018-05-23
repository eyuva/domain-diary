<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\Domain;
use App\Helpers\Whois;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = auth()->user();
        $domain = Domain::where('user_id','=',$user->id)->findOrFail($id);
        $data['dns'] = dns_get_record($domain->name,DNS_ALL);
        return view('domain.index',$data);
    }
    public function edit($id)
    {
        $user = auth()->user();
        $data['domain'] = Domain::where('user_id','=',$user->id)->findOrFail($id);
        $data['categories'] = $user->categories;
        $data['tags'] = $user->tags;
        return view('domain.edit',$data);
    }
    public function save()
    {
        $domain_name = str_replace('http://','',request()->domain);
        $domain_name = str_replace('https://','',$domain_name);
        $domain_name = str_replace('www.','',$domain_name);
        $domain_name = parse_url('http://'.$domain_name)['host'];

        $whois = new Whois();
        $whois_result = $whois->LookupDomain($domain_name);
        $updated_on = date('Y-m-d H:i:s',strtotime($whois_result['updated-date']));
        $registered_on = date('Y-m-d H:i:s',strtotime($whois_result['creation-date']));
        $expires_on = date('Y-m-d H:i:s',strtotime($whois_result['registry-expiry-date']));

        $user = auth()->user();
        if(isset(request()->domain_id)){
            $domain = Domain::where('user_id','=',$user->id)->findOrFail(request()->domain_id);
            $message = 'Domain Updated!';
        }else{
            $domain = new Domain();
            $message = 'Domain Added!';
        }
        $domain->user_id = $user->id;
        $domain->category_id = request()->category;
        $domain->registered_on = request()->registered_on?:$registered_on;
        $domain->expires_on = request()->expires_on?:$expires_on;
        $domain->updated_on = request()->updated_on?:$updated_on;
        $domain->name = $domain_name;
        $domain->save();

        $domain->tags()->sync(request()->tags);

        $toast['type'] = 'info';
        $toast['message'] = $message;
        return back()->with(['toast' => $toast]);
    }
    public function delete($id)
    {
        $user = auth()->user();
        $domain = Domain::where('user_id','=',$user->id)->findOrFail($id);
        $domain->delete();

        $toast['type'] = 'info';
        $toast['message'] = 'Domain Deleted!';
        return back()->with(['toast' => $toast]);
    }
}
