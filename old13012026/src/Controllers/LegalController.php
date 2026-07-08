<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

/**
 * LegalController
 * 
 * Handles all legal and informational pages required for AdSense approval
 * and GDPR compliance.
 */
class LegalController
{
    private Twig $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    /**
     * Privacy Policy (Integritetspolicy)
     * Required by: AdSense, GDPR
     */
    public function integritetspolicy(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'legal/integritetspolicy.twig', [
            'title' => 'Integritetspolicy | Raknalon.se',
            'description' => 'Läs om hur Raknalon.se hanterar dina personuppgifter och din integritet enligt GDPR.',
            'current_path' => '/integritetspolicy'
        ]);
    }

    /**
     * About Us (Om oss)
     * Required by: AdSense (E-E-A-T), Trust signals
     */
    public function omOss(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'legal/om-oss.twig', [
            'title' => 'Om oss | Raknalon.se',
            'description' => 'Lär känna Raknalon.se - din pålitliga källa för lönekalkylatorer och lönestatistik i Sverige.',
            'current_path' => '/om-oss'
        ]);
    }

    /**
     * Contact Page (Kontakt)
     * Required by: AdSense, Trust signals
     */
    public function kontakt(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'legal/kontakt.twig', [
            'title' => 'Kontakta oss | Raknalon.se',
            'description' => 'Kontakta Raknalon.se för frågor om löneberäkningar, feedback eller hjälp. Vi svarar inom 24 timmar.',
            'current_path' => '/kontakt'
        ]);
    }

    /**
     * Cookie Policy (Cookiepolicy)
     * Required by: EU ePrivacy Directive, GDPR
     */
    public function cookies(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'legal/cookies.twig', [
            'title' => 'Cookiepolicy | Raknalon.se',
            'description' => 'Information om hur Raknalon.se använder cookies och hur du kan hantera dem.',
            'current_path' => '/cookies'
        ]);
    }

    /**
     * Disclaimer (Ansvarsfriskrivning)
     * Required by: YMYL (Your Money Your Life) content best practices
     */
    public function ansvarsfriskrivning(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'legal/ansvarsfriskrivning.twig', [
            'title' => 'Ansvarsfriskrivning | Raknalon.se',
            'description' => 'Viktig information om begränsningar och ansvarsfriskrivning för Raknalon.se lönekalkylatorer.',
            'current_path' => '/ansvarsfriskrivning'
        ]);
    }

    /**
     * Methodology Page (Så räknar vi)
     * Required by: E-E-A-T (Expertise demonstration)
     */
    public function metodologi(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'legal/metodologi.twig', [
            'title' => 'Så räknar vi | Raknalon.se',
            'description' => 'Transparent förklaring av hur Raknalon.se beräknar din nettolön, skatter och jobbskatteavdrag.',
            'current_path' => '/sa-raknar-vi'
        ]);
    }
}
