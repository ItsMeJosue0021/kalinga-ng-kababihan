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
}
