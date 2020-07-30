<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{

    protected $list = 'Employees';

    protected $singular = 'Employee';

    public function __construct(Employee $employee)
    {
      $this->Employee = $employee;
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $list = $this->list;
      $singular = $this->singular;
      $employees = $this->Employee->orderBy('updated_at', 'desc')->paginate(10);

      return view('home')
        ->with('list', $list)
        ->with('singular', $singular)
        ->with('employees', $employees)
        ->with('pagination', $employees);
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
      $this->validate($request,[
        'first_name' => 'required|max:191',
        'last_name' => 'required|max:191',
        'company' => 'required|max:191'
      ]);

      $Employee = new Employee;
      $Employee->first_name = $request->input('first_name');
      $Employee->last_name = $request->input('last_name');
      $Employee->company = $request->input('company');
      $Employee->email = $request->input('email');
      $Employee->phone = $request->input('phone');
      $Employee->save();

      return redirect('/home/employees')->with('status', 'employee data saved successfully');

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
    public function update($employee, Request $request)
    {
        $request->request->remove('_token');
        $this->Employee->where('id', '=', $employee)->update($request->all());

        return redirect('/home/employees')->with('status', 'employee data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Employee->where('id', '=', $id)->delete();
        return redirect('/home/employees')->with('status', 'employee data deleted successfully');
    }
}
