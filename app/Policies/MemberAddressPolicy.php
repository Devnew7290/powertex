<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\MemberAddress;

class MemberAddressPolicy
{
    public function update(Member $member, MemberAddress $address)
    {
        return $member->id === $address->member_id;
    }

    public function delete(Member $member, MemberAddress $address)
    {
        return $member->id === $address->member_id;
    }

    // ถ้ามี method สำหรับตั้ง default ก็เพิ่มด้วย
    public function setDefault(Member $member, MemberAddress $address)
    {
        return $member->id === $address->member_id;
    }
}
