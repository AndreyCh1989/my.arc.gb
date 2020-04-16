<?php


namespace Controller\user;


use Controller\PageControllerInterface;
use Framework\BaseController;
use Service\User\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Logout extends BaseController implements PageControllerInterface
{
    /**
     * Выходим из системы
     * @param Request $request
     * @return Response
     */
    public function action(Request $request): Response
    {
        (new Security($request->getSession()))->logout();

        return $this->redirect('index');
    }
}