<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('user')->get();
        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'user_id' => (string) $request->user_id,
            'course_id' => (string) $request->course_id,
        ]);

        $uuidPattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

        if (!preg_match($uuidPattern, $request->user_id)) {
            return redirect()->back()->with('error', 'معرف المستخدم (user_id) غير صالح، يرجى إدخال UUID صحيح.');
        }

        if (!preg_match($uuidPattern, $request->course_id)) {
            return redirect()->back()->with('error', 'معرف الدورة (course_id) غير صالح، يرجى إدخال UUID صحيح.');
        }

        $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'course_id' => 'required|uuid',
        ]);

        try {
            Wishlist::create([
                'id' => Str::uuid()->toString(),
                'user_id' => $request->user_id,
                'course_id' => $request->course_id,
                'created_at' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to add to wishlist: ' . $e->getMessage());
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة الدورة إلى قائمة الرغبات');
        }

        return redirect()->back()->with('success', 'تمت إضافة الدورة إلى قائمة الرغبات');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();

        return redirect()->back()->with('success', 'تم حذف العنصر من قائمة الرغبات');
    }
}
