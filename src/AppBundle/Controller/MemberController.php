<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Member;
use AppBundle\Form\MemberType;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberController extends AbstractController
{

    private function createOrUpdate($member, $request, $clearMissing = true)
    {
        $form = $this->createForm(MemberType::class, $member);

        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $this->getEm()->persist($member);
            $this->getEm()->flush();
            return $member;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View()
     * @Rest\Get("/members")
     */
    public function getMembersAction(Request $request)
    {
        $members = $this->getEm()
            ->getRepository(Member::class)
            ->findAllJoinAddresses();

        return $members;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/members/{id}")
     */
    public function getMemberAction(Request $request)
    {
        $member = $this->getEm()
            ->getRepository(Member::class)
            ->findOneBy(['id' => $request->get('id')]);

        if (empty($member)) {
            return new JsonResponse(['message' => 'Member not found'], Response::HTTP_NOT_FOUND);
        }

        return $member;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/members")
     */
    public function postMembersAction(Request $request)
    {
        $member = new Member();
        return $this->createOrUpdate($member, $request);
    }

    /**
    * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
    * @Rest\Delete("/members/{id}")
    */
    public function removeMemberAction(Request $request)
    {
        $member = $this->getEm()
            ->getRepository(Member::class)
            ->find($request->get('id'));

        if ($member) {
            $this->getEm()->remove($member);
            $this->getEm()->flush();
        }
    }

    /**
     * @Rest\View()
     * @Rest\Put("/members/{id}")
     */
    public function updateMemberAction(Request $request)
    {
        $member = $this->getEm()
            ->getRepository(Member::class)
            ->find($request->get('id'));

        if (empty($member)) {
            return new JsonResponse(['message' => 'Member not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->createOrUpdate($member, $request);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/members/{id}")
     */
    public function patchMemberAction(Request $request)
    {
        $member = $this->getEm()
            ->getRepository(Member::class)
            ->find($request->get('id'));

        if (empty($member)) {
            return new JsonResponse(['message' => 'Member not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->createOrUpdate($member, $request, false);
    }
}
