<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // แสดงฟอร์ม login
    public function showLoginForm()
    {
        return view('auth.login'); // view('auth.login') ตามตัวอย่างของคุณ
    }

    // ประมวลผล login
    public function login(Request $request)
    {
        // Validate ข้อมูลก่อน
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'กรุณากรอกอีเมล',
            'email.email'       => 'รูปแบบอีเมลไม่ถูกต้อง',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Auth สำเร็จ
            $user = Auth::user();

            // เฉพาะคนที่มี role เหล่านี้เท่านั้นที่เข้าได้
            if ($user->hasAnyRole(['Super Admin', 'Developer', 'Editor'])) {
                // อัปเดต last_login หรือ log activity ตามต้องการ

                return redirect()->route('home.banner.index'); // แก้เป็น route dashboard หลังบ้านที่คุณใช้จริง
            } else {
                Auth::logout();
                return redirect()->route('back.login')
                    ->withErrors(['email' => 'คุณไม่มีสิทธิ์เข้าถึงหลังบ้าน']);
            }
        }

        // Auth ไม่สำเร็จ
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง']);
    }

    // ออกจากระบบ
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('back.login');
    }
}
