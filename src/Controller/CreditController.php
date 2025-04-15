<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
use App\Request\CreditRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreditController extends AbstractController
{
    #[Route('/credit/calculate', name: 'credit_calculate', methods: ['GET'])]
    public function calculate(CreditRequest $request, EntityManagerInterface $entityManager): Response
    {
        $request->validate();

        $price = $request->price;
        $initialPayment = $request->initialPayment;
        $loanTerm = $request->loanTerm;

        $query = $entityManager->getRepository(Program::class)
                ->createQueryBuilder('p')->select('p.id','p.name', 'p.interestRate')
                ->where('p.maxLoanTerm <= :loanTerm')
                ->setParameter('loanTerm', $loanTerm)
                ->andWhere('p.minInitialPayment >= :initialPayment')
                ->setParameter('initialPayment', $initialPayment)
                ->setMaxResults(1)
                ->getQuery();
        $program = $query->getOneOrNullResult();

        if (isset($program) > 0) {
            return $this->json([
                'programID' => $program['id'],
                'interestRate' => $program['interestRate'],
                'monthlyPayment' => $this->getMonthlyPayment($price, $initialPayment, $loanTerm, $program['interestRate']),
                'title' => $program['name'],
            ]);
        }

        return $this->json([
            'message' => 'Не удалось подобрать для вас подходящую программу',
        ]);
    }

    private function getMonthlyPayment($price, $initialPayment, $loanTerm, $interestRate): int
    {
        $P = $price - $initialPayment;
        $r = $interestRate / 12 / 100;
        $n = $loanTerm;

        $annuityRatio = ($r * (1 + $r) ** $n) / ((1 + $r) ** $n - 1);

        return (int) round($P * $annuityRatio);
    }
}
