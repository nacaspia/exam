<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildrenController extends Controller
{
    public $currentLang;
    public $currentUser;
    public $currentTime;
    public function __construct()
    {
        $this->currentLang = language();
        $this->currentTime = time_now();
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (user()->type != 'parent')
        {
            return redirect()->back();
        }
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.$this->currentLang,'ASC')->get();
        return view('site.user.children.create',compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'class_id' => 'required|integer|exists:school_classes,id'
        ]);
        try {
            Children::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'surname' => $data['surname'],
                'class_id' => $data['class_id'],
            ]);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Uşağ əlavə edildi',
                'redirect' => route('site.user.children.create', ['locale' => app()->getLocale()])]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['success' => false, 'errors' => ['Sistem xəttası!']]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $locale, string $id)
    {
        if (user()->type != 'parent') { return redirect()->back(); }
        if (empty($id)) { return redirect()->back(); };
        $classes = SchoolClass::where(['status' => 1])->orderBy('name->'.$this->currentLang,'ASC')->get();
        $children = Children::with(['user','class'])->where(['is_deleted' => false, 'user_id' => \user()->id, 'id' => $id])->first();
        return view('site.user.children.edit',compact('classes','children'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale, string $id)
    {

        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'class_id' => 'required|integer|exists:school_classes,id'
        ]);
        try {
            Children::where(['user_id' => $user->id, 'id'=> $id])->update([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'class_id' => $data['class_id'],
            ]);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Uşağ əlavə edildi',
                'redirect' => route('site.user.children.edit', ['locale' => app()->getLocale(),'id' => $id])]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['success' => false, 'errors' => ['Sistem xəttası!']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $local,int $id)
    {
        $user = auth()->user();
        try {
            Children::where(['user_id' => $user->id, 'id'=> $id])->update(['is_deleted' => 1]);
            DB::commit();

            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
