<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingsController extends Controller
{
    public function store() {
        $user = Auth::user();
        $categories = Category::all();
        return view('pages.dashboard-settings',[
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    public function account() {
        $user = Auth::user();
        return view('pages.dashboard-account',[
            'user' => $user,
        ]);
    }

    public function update(Request $request, $redirect) {
        $data = $request->all();
        $item = Auth::user();

        // update data user dari form yg diinput (request yg dikirim)
        $item->update($data);
        // redirect ke halaman yg dibuka sebelumnya
        return redirect()->route($redirect);
    }
}
