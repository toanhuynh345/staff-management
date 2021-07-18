<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    protected $_walletTransaction;

    public function __construct(WalletTransactionInterface $walletTransService)
    {
        $this->_walletTransaction = $walletTransService;
        View::share('sidebarNavDashboard', 'active');
    }

    public function index()
    {
        return view('admin.home.index', []);
    }

}
