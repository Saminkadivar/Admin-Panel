<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user','product')->latest()->paginate(10);
        // $orders = Order::all();
        return view('product.ordin', compact('orders'));
    }
    public function getOrders()
{
    $orders = Order::with('user','product')->select('orders.*');

    return DataTables::of($orders)
        ->addColumn('user_name', function($order) {
            return $order->user->name ?? 'Guest';
        })
         ->addColumn('product_name', function($order) {
            return $order->product->p_name ?? 'Guest';
        })
        ->addColumn('status_badge', function($order) {
            if ($order->status == 'pending') {
                return '<span class="badge bg-warning text-dark">Pending</span>';
            } elseif ($order->status == 'completed') {
                return '<span class="badge bg-success">Completed</span>';
            } else {
                return '<span class="badge bg-danger">Cancelled</span>';
            }
        })
        ->addColumn('action', function($order) {
            $url = route('product.ordshow', $order->id);
            return '<a href="'.$url.'" class="btn btn-sm btn-primary">View</a>';
        })
        ->rawColumns(['status_badge', 'action'])
        ->make(true);
}

    public function show(Order $order)
    {
        $order->load('user');

        return view('product.ordshow', compact('order'));
    }
}
