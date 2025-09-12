<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inquiry;

use App\newsletter;
use App\Program;
use App\imagetable;
use SoapClient;
use App\Product;
use App\Category;
use App\Banner;
use App\ProductAttribute;
use DB;
use View;
use Session;
use App\Http\Traits\HelperTrait;
use App\orders;
use App\orders_products;
use Illuminate\Contracts\Session\Session as SessionSession;

class ProductController extends Controller
{
	use HelperTrait;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// use Helper;

	public function __construct()
	{
		//$this->middleware('auth');
		$logo = imagetable::select('img_path')
			->where('table_name', '=', 'logo')
			->first();

		$favicon = imagetable::select('img_path')
			->where('table_name', '=', 'favicon')
			->first();

		View()->share('logo', $logo);
		View()->share('favicon', $favicon);
		//View()->share('config',$config);
	}

	public function index()
	{
		$products = new Product;
		if (isset($_GET['q']) && $_GET['q'] != '') {

			$keyword = $_GET['q'];

			$products = $products->where(function ($query)  use ($keyword) {
				$query->where('product_title', 'like', $keyword);
			});
		}
		$products = $products->orderBy('id', 'asc')->get();
		return view('products', ['products' => $products]);
	}

	public function productDetail($id)
	{

		$product = new Product;
		$product_detail = $product->where('id', $id)->first();
		$products = DB::table('products')->get()->take(10);
		return view('product_detail', ['product_detail' => $product_detail, 'products' => $products]);
	}


	public function saveCart(Request $request)
	{


		$var_item = $_POST['variation'];

		$result = array();


		$product_detail = DB::table('products')->where('id', $_POST['product_id'])->first();
		$id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
		$qty = isset($_POST['qty']) ? intval($_POST['qty']) : '1';
        dd($product_detail);


		$cart = array();
		$cartId = $id;
		if (Session::has('cart')) {

			$cart = Session::get('cart');
		}

		$price = $product_detail->price;


		if ($id != "" && intval($qty) > 0) {

			if (array_key_exists($cartId, $cart)) {
				unset($cart[$cartId]);
			}
			$productFirstrow = Product::where('id', $id)->first();


			$cart[$cartId]['id'] = $id;
			$cart[$cartId]['name'] = $productFirstrow->product_title;
			$cart[$cartId]['baseprice'] = $price;
			$cart[$cartId]['qty'] = $qty;
			$cart[$cartId]['variation_price'] = 0;

			foreach ($var_item as $key => $value) {

				$data = ProductAttribute::where('product_id', $_POST['product_id'])
					->where('value', $value)->first();
				$cart[$cartId]['variation'][$data->id]['attribute'] = 	$data->attribute->name;
				$cart[$cartId]['variation'][$data->id]['attribute_val'] = 	$data->attributesValues->value;
				$cart[$cartId]['variation'][$data->id]['attribute_price'] = 	$data->price;
				$cart[$cartId]['variation_price'] += $data->price;
			}


			Session::put('cart', $cart);
			Session::flash('message', 'Product Added to cart Successfully');
			Session::flash('alert-class', 'alert-success');
			return redirect('/cart');
		} else {
			Session::flash('flash_message', 'Sorry! You can not proceed with 0 quantity');
			Session::flash('alert-class', 'alert-success');
			return back();
		}
	}
	public function updateCart()
	{

		$cart = Session::get('cart');
		$pro_id = $_POST['product_id'];
		$qty = $_POST['qty'];
		$count = 0;
		if (sizeof($_POST['row']) >= 1) {
			foreach ($cart as $key => $value) {
				foreach ($value as $key_item => $value_item) {
					if ($key_item == 'qty') {
						$cart[$key][$key_item] = (int)($_POST['row'][$count]);
					}
				}
				$count = $count + 1;
			}
		}



		// $productFirstrow = Product::where('id', $pro_id)->first();
		// $cart[$pro_id]['id'] = $pro_id;
		// $cart[$pro_id]['name'] = $productFirstrow->product_title;
		// $cart[$pro_id]['baseprice'] = $productFirstrow->price;
		// $cart[$pro_id]['qty'] = $qty;


		$variation_total = 0;
		foreach ($cart[$pro_id]['variation'] as $key => $value) {
			$variation_total += $value['attribute_price'];
		}

		$cart[$pro_id]['variation_price'] = $variation_total * $qty;


		Session::put('cart', $cart);
		Session::flash('message', 'Your Cart Updated Successfully');
		Session::flash('alert-class', 'alert-success');
		return redirect('/checkout');
	}


	public function removeCart($id)
	{

		//$id = isset($_POST['ArrayofArrays'][0]) ? $_POST['ArrayofArrays'][0] : '';

		if ($id != "") {

			if (Session::has('cart')) {

				$cart = Session::get('cart');
			}

			if (array_key_exists($id, $cart)) {

				unset($cart[$id]);
			}

			Session::put('cart', $cart);
		}

		// echo 'success';
		Session::flash('flash_message', 'Product item removed successfully');
		Session::flash('alert-class', 'alert-success');
		return back();
	}


	public function invoice($id)
	{

		$order_id = $id;
		$order = orders::where('id', $order_id)->first();
		$order_products = orders_products::where('orders_id', $order_id)->get();

		return view('account.invoice')->with('title', 'Invoice #' . $order_id)->with(compact('order', 'order_products'))->with('order_id', $order_id);;
	}

	public function checkout()
	{

		dd(Session::get('cart'));

		if (Session::get('cart') && count(Session::get('cart')) > 0) {
			$countries = DB::table('countries')
				->get();
			return view('checkout', ['cart' => Session::get('cart'), 'countries' => $countries]);
		} else {
			Session::flash('flash_message', 'No Product found');
			Session::flash('alert-class', 'alert-success');
			return redirect('/');
		}
	}



}
