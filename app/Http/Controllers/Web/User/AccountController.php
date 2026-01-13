<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\QuestionOption;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public $currentLang;
    public $currentUser;
    public $currentTime;
    public function __construct()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
    }

    public function account() {
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.$this->currentLang,'ASC')->get();
        $children = Children::with(['user','class'])->where(['is_deleted' => 0, 'user_id' => \user()->id])->orderBy('id','DESC')->get();
// İstifadəçinin imtahan nəticələri
        $examResults = ExamResult::with(['exam', 'exam.questions'])
            ->where('user_id', \user()->id)
            ->orderBy('created_at','DESC')
            ->take(10) // son 10 imtahan
            ->get();

        return view('site.user.account',compact('classes','children','examResults'));
    }
    public function settings() {
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.$this->currentLang,'ASC')->get();
        return view('site.user.settings',compact('classes'));
    }

    public function settingsUpdate(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:100|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => 'nullable|confirmed|min:6',
        ]);
        try {
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            return response()->json(['success' => true, 'message' => 'Ayarlar yeniləndi',
                'redirect' => route('site.user.settings', ['locale' => app()->getLocale()])]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'errors' => ['Sistem xəttası!']]);
        }
    }

}
