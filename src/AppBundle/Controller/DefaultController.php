<?php

namespace AppBundle\Controller;

use AppBundle\Service\Notification\EmailNotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @var EmailNotificationService
     */
    private $notificationEmail;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //Injeção de dependencia tabajara
        $this->notificationEmail = $this->get("service.notification.email");

        if ($request->isMethod('post')) {

            $title = $request->get('title');
            $text  = $request->get('text');

            $response = $this->notificationEmail->sendEmail($title, $text);

            $msg = "";
            if ($response === false) {
                $msg = "ERRO ao enviar o email";
            } else {
                $msg = "Mensagem enviada com sucesso";
            }

            return $this->render('@App/index.html.twig', [
                "msg" => $msg
            ]);
        }

        return $this->render('@App/index.html.twig');
    }
}
