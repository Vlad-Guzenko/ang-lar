<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Contact;
use App\Models\Result;
use http\Client\Response;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;
use function Composer\Autoload\includeFile;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $con = Contact::all();
        return $con;


        /*foreach ($contacts as $contact)
        {
            var_dump($contact);
        }*/


        /*foreach ($contacts as $contact)
        {
            $res = new Result($contact);

            $res->emails = Email::query()
                ->select('email')
                ->where('emails.contact_id','=', $contact->id);
            var_dump($contact->id);
            var_dump($res);
            array_push($results, $res);
        }*/
        /*return $contacts;*/

    }


    /*public function getEm($id){
       return $emails = Email::query()
           ->where('emails.contact_id','=',$id)
           ->get();
    }*/

    /*public function getAllEm(){
        return Email::all();
    }*/


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        return view('contacts.create');
    }*/

    public function search(Request $request)
    {
        $search = $request->get('search');
        $search2 = $request->get('search');
        $data = Contact::query()
            ->where('first_name', 'like', '%' . $search2 . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('job_title', 'like', '%' . $search . '%')
            ->orWhere('company_name', 'like', '%' . $search . '%')
            ->orWhere('age', 'like', '%' . $search . '%')
            ->get();

        $data2 = Email::query(2)
            ->where('email', 'like', '%' . $search2 . '%')
            ->get();
        //var_dump($search);
        return view('contacts.search', compact('data', 'data2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|unique:contacts,email',
            'job_title'=>'required',
            'company_name'=>'required',
            'age'=>'required'
        ]);

        $contact = new Contact([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'job_title' => $request->get('job_title'),
            'company_name' => $request->get('company_name'),
            'age' => $request->get('age')
        ]);
        $contact->save();

        return $contact;
    }

    /*public function getEmail(Request $request){
        return Email::all()->contains($request);
    }*/

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Contact::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /*public function emDestroy($id)
    {
        $email = Email::find($id);
        $email->delete();

        return redirect('/contacts.edit')->with('success', 'Email removed!');
    }*/

    /*public static function getCountEmails()
    {
        return $emails = DB::table('emails')->count('email');
    }*/

    /*public static function getCountClients()
    {
        return $clients = DB::table('contacts')->count('id');
    }*/

    /*public function email()
    {
        $contacts = Contact::all();
        $email = $contacts;
        $countEmails = self::getCountEmails();
        $email = Email::all();
        return $email;
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           $this->validate($request , array(
            'first_name'=>'required|max:100',
            'last_name'=>'required',
            'email'=>"required|email|unique:contacts,email,$id",
            'job_title'=>'required',
            'company_name'=>'required',
            'age'=>'required'
        ));

           $contact = Contact::findOrFail($id);


        $contact->first_name = trim($request->first_name);
        $contact->last_name = trim($request->last_name);
        $contact->email = trim($request->email);
        $contact->job_title = trim($request->job_title);
        $contact->company_name = trim($request->company_name);
        $contact->age = trim($request->age);


        $contact->update($request->all());
        return $contact;

        /*$emails = Email::find($id);
        $emails->email = $request->get('email');
        $emails->save();

        $contact = Contact::find($id);
        $contact->first_name =  $request->get('first_name');
        $contact->last_name = $request->get('last_name');
        $contact->job_title = $request->get('job_title');
        $contact->company_name = $request->get('company_name');
        $contact->age = $request->get('age');
        $contact->save();

        return redirect('/contacts')->with('success', 'Contact updated!');*/
    }

    public function getEmails(){
        return Contact::query()->select('email')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['Deleted']);
    }

    public function __invoke(Request $request)
    {
        return;
    }
}
