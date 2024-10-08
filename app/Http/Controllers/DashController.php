<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Create;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Client;
use App\Models\Request as ModelsRequest;
use App\Models\qrcode;
use Carbon\Carbon;
class DashController extends Controller
{
    public function task(){

        $supplier = Supplier::count(); //suppliers not create task
        $user = User::count(); 
        $transaction = Transaction::count();
        $client = Client::count();
        $users = User::all();
        // Return the admin dashboard view with the data and user count
        return view('admin.dashboard', compact('supplier','user', 'client','transaction', 'users'));
    }
    public function create(){
        return view('admin.createtask');
    }
    public function createtask(Request $request){
        $attrs = $request->validate([
            'office_name' => 'required',
            'task' => 'required',
            'time' => 'required',
        ]);
        
        Create::create([
            'Office_name' => $attrs['office_name'],
            'Office_task' => $attrs['task'],
            'New_alloted_time' => $attrs['time'],
            'user_id' => 1,
            'soft_del' => 0,
        ]);
        

        $supplier = Supplier::count(); //suppliers not create task
        $user = User::count(); 
        $transaction = Transaction::count();
        $client = Client::count();
        $users = User::all();
        // Return the admin dashboard view with the data and user count
        return view('admin.dashboard', compact('supplier','user', 'client','transaction', 'users'));
    }
    public function list(){
        $data = Create::all()->where('soft_del','=','0');
        return view('admin.listtask', compact('data'));
    }
    public function edit($id){

        $data = Create::findOrFail($id);
        
        return view('admin.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $attrs = $request->validate([
            'Office_name' => 'required',
            'Office_task' => 'required',
            'New_alloted_time' => 'required',
        ]);

        // Debugging to ensure data is received
        //dd($request->all());

        // Find the record by ID
        $record = Create::findOrFail($id);

        // Update the record
        $record->update([
            'Office_name' => $attrs['Office_name'],
            'Office_task' => $attrs['Office_task'],
            'New_alloted_time' => $attrs['New_alloted_time'],
        ]);

        // Redirect to a specific page or view
        $supplier = Supplier::count(); //suppliers not create task
        $user = User::count(); 
        $transaction = Transaction::count();
        $client = Client::count();
        $users = User::all();
        // Return the admin dashboard view with the data and user count
        return view('admin.dashboard', compact('supplier','user', 'client','transaction', 'users'));
    }
    public function delete($id){
        
        $record = Create::findOrFail($id);
        $record->update([
            'soft_del' => 1,
        ]);
        $supplier = Supplier::count(); //suppliers not create task
        $user = User::count(); 
        $transaction = Transaction::count();
        $client = Client::count();
        $users = User::all();
        // Return the admin dashboard view with the data and user count
        return view('admin.dashboard', compact('supplier','user', 'client','transaction', 'users'));
                         
    }

    public function supplier(){
        $supplier = Supplier::all();

        return view('admin.supplier', compact('supplier'));
    }
    public function clients(){
        $clients = Client::all();

        return view('admin.clients', compact('clients'));
    }
    public function transaction(){
        $transaction = Transaction::all();

        return view('admin.transaction', compact('transaction'));
    }
    public function user(){
        $user = User::all();

        return view('admin.user', compact('user'));
    }
    public function request(){
        $data = [
            'labels' => Carbon::now()->subMonths()->format('F'),
            'data' => [65, 59, 80, 81],
        ];
        $request = ModelsRequest::all();

        return view('admin.request', compact('request','data'));
    }
    public function qrcode(){
        $qrcode = qrcode::all();

        return view('admin.qrcode', compact('qrcode'));
    }

}
