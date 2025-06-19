<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberAddress;
use Illuminate\Support\Facades\DB;

class MemberAddressController extends Controller
{
    public function index()
    {
        $addresses = auth('member')->user()
            ->memberAddresses()
            ->where('type', 'shipping')
            ->orderByDesc('is_default')
            ->get();
        return view('frontend.member-address', compact('addresses'));
    }

    public function create()
    {
        return view('frontend.member-address-add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname'    => 'required|string',
            'lastname'     => 'required|string',
            'address'      => 'required|string',
            'province'     => 'required|string',
            'district'     => 'required|string',
            'sub_district' => 'required|string',
            'postcode'     => 'required|string',
            'phone'        => 'required|string',
        ]) + ['member_id' => auth('member')->id()];

        // ถ้าเป็นที่อยู่แรก ให้ตั้งเป็น default
        if (auth('member')->user()->memberAddresses()->count() == 0) {
            $data['is_default'] = true;
        }

        MemberAddress::create($data);
        return redirect()->route('member.address')
                         ->with('success', 'เพิ่มที่อยู่เรียบร้อยแล้ว');
    }

    public function edit(MemberAddress $address)
    {
        $this->authorize('update', $address);
        return view('frontend.member-address-edit', compact('address'));
    }

    public function update(Request $request, MemberAddress $address)
    {
        $this->authorize('update', $address);
        $data = $request->validate([
            'firstname'    => 'required|string',
            'lastname'     => 'required|string',
            'address'      => 'required|string',
            'province'     => 'required|string',
            'district'     => 'required|string',
            'sub_district' => 'required|string',
            'postcode'     => 'required|string',
            'phone'        => 'required|string',
        ]);
        $address->update($data);
        return redirect()->route('member.address')
                         ->with('success', 'แก้ไขที่อยู่เรียบร้อยแล้ว');
    }

    public function destroy(MemberAddress $address)
    {
        $this->authorize('delete', $address);
        $address->delete();
        return back()->with('success', 'ลบที่อยู่เรียบร้อยแล้ว');
    }

    public function setDefault(MemberAddress $address)
    {
        $this->authorize('update', $address);
        DB::transaction(function() use($address) {
            auth('member')->user()->memberAddresses()
                ->update(['is_default' => false]);
            $address->update(['is_default' => true]);
        });
        return back()->with('success', 'ตั้งเป็นที่อยู่หลักแล้ว');
    }
}
