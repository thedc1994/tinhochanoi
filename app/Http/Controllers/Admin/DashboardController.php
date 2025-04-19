<?php
/**
 * File name : DashboardController.php  / Date:  - 12:16 AM
 * Code Owner: Tke / Phone: 0367313134 / Email: thedc.it.94@gmail.com
 */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
