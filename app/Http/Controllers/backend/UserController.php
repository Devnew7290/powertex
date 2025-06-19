<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $allMenus = [
        'home' => 'หน้าแรก',
        'gallery' => 'แกลอรี่',
        'product_brand' => 'แบรนด์สินค้า',
        'product_type' => 'หมวดหมู่สินค้า',
        'product_detail' => 'สินค้า',
        'aboutus' => 'เกี่ยวกับเรา',
        'article' => 'บทความ',
        'news' => 'ข่าว',
        'promotion' => 'โปรโมชั่น',
        'promocode' => 'โค้ดส่วนลด',
        'dealer' => 'ตัวแทนจำหน่าย',
        'contact' => 'ติดต่อเรา',
        'repairs' => 'แจ้งซ่อม',
        'warranty' => 'รับประกันสินค้าออนไลน์',
        'catalog' => 'แคตตาล็อก',
        'manage_users' => 'จัดการผู้ใช้งาน',
    ];

    public function index()
    {
        // ดึงเฉพาะ user ทุกคน (หรือจะ filter เฉพาะกลุ่มก็ได้)
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        // เฉพาะ role super admin กับ developer ให้เลือก
        $roles = Role::whereIn('name', ['Super Admin', 'Developer', 'Editor'])->get();
        $allMenus = $this->allMenus;
        return view('backend.users.create', compact('roles', 'allMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|exists:roles,name',
            'menus'    => 'nullable|array',
        ]);

         if (!isset($request->menus)) {
            return redirect()->route('backend.users.index')->with('error', 'กรุณาเลือกเมนูอย่างน้อย 1 รายการง');
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'menus'    => $request->menus ?? []
        ]);
        $user->assignRole($request->role);

        return redirect()->route('backend.users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['Super Admin', 'Developer', 'Editor'])->get();
        $allMenus = $this->allMenus;
        return view('backend.users.edit', compact('user', 'roles', 'allMenus'));
    }

    public function update(Request $request, User $user)
    {
        // dd($request->all());

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => 'required|exists:roles,name',
            'menus'    => 'nullable|array',
        ]);

        if (!isset($request->menus)) {
            return redirect()->route('backend.users.index')->with('error', 'กรุณาเลือกเมนูอย่างน้อย 1 รายการ');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }
        $user->menus = $request->menus ?? [];
        $user->save();

        $user->syncRoles([$request->role]);

        return redirect()->route('backend.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('backend.users.index')->with('success', 'User deleted successfully');
    }
}
