<?php

namespace App\Controller;


use App\Shortener\Interfaces\InterfaceUrlDecoder;
use App\Shortener\Interfaces\InterfaceUrlEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrlConverterController extends AbstractController
{
    #[Route('/encode/{url}', name: 'encode', requirements: ['url' => '.*'])]
    public function encode(string $url, InterfaceUrlEncoder $converter): Response
    {
        $code = $converter->encode($url);
        $content = 'Url: '. $url ." | Code: ". $code;
        return new Response($content);
    }

    #[Route('/decode/{code}', name: 'decode', requirements: ['code' => '.*'])]
    public function decode(string $code, InterfaceUrlDecoder $converter): Response
    {
        $url = $converter->decode($code);
        $content = 'Code: '. $code ." | Url: ". $url;
        return new Response($content);
    }
}
