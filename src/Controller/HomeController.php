<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Currency;

class HomeController extends AbstractController
{
    /**
     * Currency table list page.
     *
     * @Route("/")
     */
    public function index()
    {
        $currencyRepository = $this->getDoctrine()->getRepository(Currency::class);
        $exchangeRates = $currencyRepository->lowestPrice();

        return $this->render('home/index.html.twig', [
            'exchangeRates' => $exchangeRates,
        ]);
    }
}
