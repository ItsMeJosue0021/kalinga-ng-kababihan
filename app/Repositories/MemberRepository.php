<?php

namespace App\Repositories;

use App\Models\Member;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberRepository implements MemberRepositoryInterface
{
    public function getAll()
    {
        return Member::all();
    }

    public function find($id)
    {
        return Member::findOrFail($id);
    }

    public function create(array $data)
    {
        return Member::create($data);
    }

    public function update($id, array $data)
    {
        $member = Member::findOrFail($id);
        $member->update($data);
        return $member;
    }

    public function delete($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return true;
    }
}
