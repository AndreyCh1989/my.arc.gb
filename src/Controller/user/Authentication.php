<?php


namespace Controller\user;

use Controller\PageControllerInterface;
use Framework\BaseController;
use Service\User\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Authentication extends BaseController implements PageControllerInterface
{
    /**
     * Производим аутентификацию и авторизацию
     * @param Request $request
     * @return Response
     */
    public function action(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $user = new Security($request->getSession());

            $isAuthenticationSuccess = $user->authentication(
                $request->request->get('login'),
                $request->request->get('password')
            );

            if ($isAuthenticationSuccess) {
                return $this->render(
                    'user/authentication_success.html.php',
                    ['user' => $user->getUser()]
                );
            }
            $error = 'Неправильный логин и/или пароль';
        }

        return $this->render(
            'user/authentication.html.php',
            ['error' => $error ?? '']
        );
    }
}