<?php

namespace App\Services;

use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberService
{
    protected $memberRepository;

    public function __construct(MemberRepositoryInterface $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function getAllMembers()
    {
        return $this->memberRepository->getAll();
    }

    public function findMemberById($id)
    {
        return $this->memberRepository->find($id);
    }

    public function createMember(array $data)
    {
        return $this->memberRepository->create($data);
    }

    public function updateMember($id, array $data)
    {
        return $this->memberRepository->update($id, $data);
    }

    public function deleteMember($id)
    {
        return $this->memberRepository->delete($id);
    }
}
