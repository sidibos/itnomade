<?php declare(strict_types = 1);

namespace App\Controller;

use App\Contracts\ConfigServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends AbstractController
{
    private $configService;

    public function __construct(ConfigServiceInterface $configService)
    {
        $this->configService = $configService;
    }

    /**
     * @Route("/about-us", name="about_us")
     */
    public function aboutUs()
    {
        $aboutUs = $this->configService->get('about-us');
        return $this->render('content/about_us.html.twig', [
            'about_us' => $aboutUs,
        ]);
    }

    /**
     * @Route("/services", name="services")
     */
    public function services()
    {
        $services = $this->configService->get('services');
        return $this->render('content/services.html.twig', [
            'services' => $services,
        ]);
    }
}
