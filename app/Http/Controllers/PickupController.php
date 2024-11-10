<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function index()
    {
        $pickups = Pickup::all(); // Sesuaikan query dengan kebutuhan
        return view('pickup.index', compact('pickups')); // Pastikan view `pickup.index` tersedia
    }
    
}
