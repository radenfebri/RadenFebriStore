<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
        // abort_if(Gate::denies('dashboard'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('backend.dashboard');
    }
}
