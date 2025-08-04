<?php

namespace App\Http\Controllers\Main;

use App\Models\Car;
use App\Models\User;
use App\Models\Order;
use App\Events\OrderEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    //Upload Car Post Method

    public function UploadCar(Request $req) {
       
       $req->validate([
        "name"=>"Required",
        "price"=>"Required",
        "quantity"=>"Required",
        "model"=>"Required",
        "file" => "Required",
       ]);

       $name = $req->input('name');

       $file = $name.".".$req->file->getClientOriginalExtension();

       $req->file->move("cars",$file);

       $car = new Car;

       $car->name = $req->name;
       $car->price = $req->price;
       $car->quantity = $req->quantity;
       $car->model = $req->model;
       $car->discount = $req->discount;
       $car->file = $file;

       $car->save();

       return redirect()->route('admin.dashboard')->with('success', 'Car Uploaded successfully.');
      }
       //ADD Car Form
      public function CarUploadForm() {
        return view('admin.uploadCar');
      }
      //Admin Dashboard Method
      public function AdminDash() {
        $orders = Order::with('users')->withTrashed()->paginate(5);
        $user = User::count();
        $order = Order::count();
        $pending = Order::where("status",'pending')->count();
        $sales = Order::sum('total');
        return view("admin.adminDash",compact('orders','user','order','pending','sales'));
      }

      //Order Management

      public function UpdateOrder($id) {
           
          $order = Order::with('users')->findOrFail($id);

          $order->status = $order->status === "pending" ? "approved" : "pending";
          $order->payment_status = $order->payment_status === "Pay After Inspection" ? "Paid" : "Pay After Inspection";
         if($order->status === "approved") {
               event(new OrderEvent($order->users->email));
           }
         $order->save();
         return redirect()->back()->with('success', 'Order status updated successfully.');

      }

      public function CancelOrder(Order $order) {
        $order->delete();
        return redirect()->back()->with('success', 'Order has been cancelled successfully.');
      }

      public function RestoreOrder($id) {
        $order = Order::withTrashed()->findOrFail($id);
        $order->restore();
        return redirect()->back()->with('success', 'Order restored successfully.');
    
      }
      //Order Management Ends Here







}
