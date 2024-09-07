<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
  public function funcEmployeForm(){
    return view('/employee');
  }

    public function funcEmployee(Request $req){
     try {
      $createEmployee = new Employee();
      $createEmployee->name=$req->name;
      $createEmployee->salary=$req->salary;
      $createEmployee->save();
      session()->flash("message","saved successfully");
      return redirect('/employee');
     } catch (\Throwable $th) {
      return $th;
     }
    }
     function displayAllEmployee(){
      try {
        $employee= Employee::all();
        return view("displayAllEmployee",['employees'=> $employee]);
      } catch (\Throwable $th) {
        throw $th;
      }     
    }

    function editEmployee( Request $req){
     $getEachEmployeData= Employee::find($req->id);
     dd($getEachEmployeData['name']);
      return view('editEmployee');
    }
}
