<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Contact;

class ContactController extends Controller
{
    public function contact_index(){
        $contact = Contact::get();
        return view('backend.contact.index', compact('contact'));
    }

    public function contact_form(){
        return view('backend.contact.add');
    }

    public function contact_create(Request $request){
        // dd($request);

        $contact                    = new Contact;
        $contact->contacts_map      = $request->contact_map;
        $contact->contacts_address  = $request->contact_address;
        $contact->contacts_phone    = $request->contact_phone;
        $contact->contacts_fax      = $request->contact_fax;
        $contact->contacts_email    = $request->contact_email;
        $contact->contacts_facebook = $request->contact_facebook;
        $contact->contacts_line     = $request->contact_line;
        $contact->contacts_ig       = $request->contact_ig;
        $contact->contacts_yt       = $request->contact_yt;
        $contact->contacts_tiktok   = $request->contact_tiktok;
        $contact->contacts_twitter  = $request->contact_x;
        $contact->FK_user_id        = Auth::user()->id;
        $contact->FK_user_name      = Auth::user()->name;
        $contact->save();

        $mes = 'Success';
        $yourURL= url('/backend/contact');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }

    public function contact_edit($id){
        $contact = Contact::where('contacts_id', $id)->first();
        return view('backend.contact.edit', compact('id', 'contact'));
    }

    public function contact_update(Request $request, $id){
        // dd($request);

        $contact['contacts_map']      = $request->contact_map;
        $contact['contacts_address']  = $request->contact_address;
        $contact['contacts_phone']    = $request->contact_phone;
        $contact['contacts_fax']      = $request->contact_fax;
        $contact['contacts_email']    = $request->contact_email;
        $contact['contacts_facebook'] = $request->contact_facebook;
        $contact['contacts_line']     = $request->contact_line;
        $contact['contacts_ig']       = $request->contact_ig;
        $contact['contacts_yt']       = $request->contact_yt;
        $contact['contacts_tiktok']   = $request->contact_tiktok;
        $contact['contacts_twitter']  = $request->contact_x;
        $contact['contacts_keyword']  = $request->contact_keyword;
        $contact['contacts_description']  = $request->contact_description;
        $contact['contacts_url']  = $request->contact_url;
        $contact['FK_user_id']        = Auth::user()->id;
        $contact['FK_user_name']      = Auth::user()->name;
        Contact::where('contacts_id', $id)->update($contact);

        $mes = 'Success';
        $yourURL= url('/backend/contact');
        echo ("<script>alert('$mes'); location.href='$yourURL'; </script>");
    }
}
