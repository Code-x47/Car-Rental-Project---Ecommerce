<?php

namespace App\Http\Controllers\User;

use App\Models\Car;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\SmartyService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    //INDEX METHOD(FIRST PAGE)
    public function indexPage() {
        $cars = Car::all();
        return view("user.index",compact('cars'));
    }

    //HOME PAGE METHOD (FOR LOGGED IN CUSTOMERS)
    public function HomePage() {
        $cars = Car::all();
        return view("dashboard",compact('cars'));
    }
     


    //ADD TO CART METHOD
    public function AddToCart(Request $req, $id) {
       
        $user = auth()->user();
        $cart = new Cart;
         
        $car = Car::find($id);

        $cart->username = $user->name;
        $cart->email = $user->email;
        $cart->file= $car->file;
        $cart->car_name= $car->name;
        $rawPrice = str_replace(',', '', $car->price); // remove commas
        $price = (float) $rawPrice;

          if (empty($car->discount) || $car->discount == 0) {
               $cart->price = $price;
          } else {
              $discountedPrice = $price * (1 - ($car->discount / 100));
            $cart->price = round($discountedPrice, 2);
          }


        $cart->model= $car->model;
        $cart->units= $req->units;
        $cart->user_id = $user->id;
        $cart->car_id = $car->id;
        
        $cart->save();

        return redirect()->route('dashboard')->with('success', 'Car Has Been Added To Cart.');

    }




    public function search(Request $request)
        {
            $query = Car::query();

            // Filter by price range
         if ($request->filled('price_range')) {
            switch ($request->price_range) {
              case '0-100000':
                $query->whereBetween('price', [0, 100000]);
                break;
               case '100000-200000':
                $query->whereBetween('price', [100000, 200000]);
                break;
               case '200000+':
                $query->where('price', '>', 200000);
                break;
             }
          }

          // Filter by model/year
          if ($request->filled('model')) {
              $query->where('model', $request->model);
            }

            $cars = $query->get();

             return view('user.search_results', compact('cars'));
           }


    // CART ITEMS METHOD
    public function ViewCart() {
        $cartItems = Cart::where('user_id',auth()->id())->get();
        return view('user.cart',compact('cartItems'));
    }
    
    // REMOVE CAR ITEMS FROM CART METHOD
    public function RemoveItem($id) {
      $remove = Cart::find($id);
      $remove->delete();

      return redirect()->back();
    } 
   

    //CAR BOOKING METHOD(ORDER METHOD)
    public function OrderCheckout(Request $req) {
        $userId = Auth::id();

        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            foreach ($cartItems as $item) {
                Order::create([
                    'user_id'  => $userId,
                    'car_name' => $item->car_name,
                    'model'    => $item->model,
                    'units'    => $item->units,
                    'price'    => $item->price,
                    'total'    => $item->price * $item->units,
                    'image'    => $item->file,
                    'billing_email' => $req->email,
                    'billing_address' => $req->address,
                    'billing_phone' => $req->phone,
                    'grand_total' => $req->grandTotal,
                    'payment_status' => "Pay After Inspection"
                ]);
            }

            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Your Order Has Been Recieved, Please check your email to know when to inspect and pay.');
           
          } catch (\Throwable $e) {
            DB::rollBack();
            
            return redirect()->back();
           
          }
      }

       
       //CAR DETAILS METHOD USING SMARTY FOR FRONTEND RENDER;

        public function CarDetails($id)
        {
          $car = Car::findOrFail($id);
          $cars_url = asset("cars/{$car->file}");
          $css_url = asset("asset/css/details.css");
          $home_url = route('dashboard'); 
          $addCart_url = route('add.cart',$car->id);
          $csrf_token = csrf_token();

          return response(SmartyService::render('carDetails', compact('car','cars_url','css_url','home_url','addCart_url','csrf_token')));
         }

         public function Checkout($grandTotal) { 
             $cars = Cart::where("user_id",auth()->id())->get();
            return view("user.checkout",compact('grandTotal','cars'));
         }
    
}
