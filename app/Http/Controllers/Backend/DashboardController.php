<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Contracts\Role;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super Admin|Admin']);
    }



    public function index()
    {
        abort_if(Gate::denies('dashboard'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $pengunjung = Visitor::latest()->paginate(10);
        $order_paid = Order::where('status', 1)->get();
        $order_unpaid = Order::where('status', 0)->get();

        return view('backend.dashboard', compact('pengunjung', 'order_paid', 'order_unpaid'));
    }
}
