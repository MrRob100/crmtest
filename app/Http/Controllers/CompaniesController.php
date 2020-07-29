<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{

    protected $list = 'Companies';

    protected $singular = 'Company';

    public function __construct(Company $company)
    {
        $this->model = $company;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $list = 'Companies';
        $list = $this->list;
        $singular = $this->singular;

        $companies = Company::paginate(10)->all();

        return view('home', compact('list', 'singular', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect('/home');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
          'name' => 'required|max:191',
        ]);


        if ($request->hasFile('logo')) {
          $fileNameWithExt = $request->file('logo')->getClientOriginalName();

          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

          $extension = $request->file('logo')->getClientOriginalExtension();

          $fileNameToStore = $filename . '_' . time() . '_' . $extension;

          $path = $request->file('logo')->storeAs('public/storage/logos/', $fileNameToStore);
        }
        else {
          $fileNameToStore = 'http://via.placeholder.com/100x100';
        }

        $Company = new Company;
        $Company->name = $request->input('name');
        $Company->email = $request->input('email');
        $Company->website = $request->input('website');
        $Company->logo = $fileNameToStore;
        $Company->save();

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
