<?php

namespace App\Http\Controllers;

use App\Models\CmsUser;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{

    public function showLoginQr()
    {
        $link = route('qr.verify');

        return view('qr-login', [
            'qr' => QrCode::size(250)->generate($link)
        ]);
    }

    public function qrVerifyForm()
    {
        return view('qr-fin');
    }

    public function qrCheck(Request $request)
    {
        $request->validate([
            'fin' => 'required|string|max:7'
        ]);

        $user = CmsUser::where('pin', strtoupper($request->fin))->first();
        if (!$user) {
            return back()->withErrors(['fin' => 'FIN tapılmadı']);
        }

        // avtomatik login
        auth('cms')->login($user);

        return redirect('/home');
    }


}
