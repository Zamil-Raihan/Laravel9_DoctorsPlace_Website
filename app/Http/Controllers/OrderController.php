<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\DoctorController;
use App\Models\Order;
use App\Models\Doctor;

class OrderController extends Controller
{
    public function order_index(Request $request){
        $search = $request->input('search');

        $orders = Order::when($search, function ($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhere('p_name', 'like', "%$search%")
                ->orWhere('p_email', 'like', "%$search%");
        })->orderBy('id','DESC')->get();
        return view('order.list_order',['orders'=>$orders]);
    }

    public function create($doctor_id)
    {
        $doctor = Doctor::findOrFail($doctor_id);
        return view('order.create_order')->with('doctor', $doctor);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'd_id' => 'required',
            'd_name' => 'required',
            'p_name' => 'required',
            'p_age' => 'required',
            'p_gender' => 'required',
            'p_email' => 'required',
            'p_num' => 'required',
            'p_date' => 'required'
        ]);
        if($validator->passes()){
            //save
            $order = new Order();
            $order->d_id = $request->d_id;
            $order->d_name = $request->d_name;
            $order->p_name = $request->p_name;
            $order->p_age = $request->p_age;
            $order->p_gender = $request->p_gender;
            $order->p_email = $request->p_email;
            $order->p_num = $request->p_num;
            $order->p_date = $request->p_date;
            $order->save();

            $request->session()->flash('success','Success, Our team will contact with you withen 4 hours. We will send you email and also call you (if nessesary)');

            return redirect()->route('doctors.index_public');
        }else{
            echo "Error, Please Try Again. Make Sure you filled up all boxes....!";
        }
    }
    
    public function destroy($id, Request $request){
        $order = Order::findOrFail($id);
        $order->delete();

        $request->session()->flash('success', 'Deleted Successful....!');
        return redirect()->route('orders.order_index');
    }
 }
