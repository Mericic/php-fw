<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Security\AccountAuthenticator;
use Metinet\Core\Security\AuthenticationContext;
use Metinet\Core\Security\AuthenticationFailed;
use Metinet\Core\Security\PlainTextPasswordEncoder;
use Metinet\Core\Session\NativeSession;
use Metinet\Core\Templating\PhpViewRenderer;
use Metinet\Domain\Conferences\Email;
use Metinet\Infrastructure\Repositories\InMemoryMemberRepository;
use Metinet\Infrastructure\Security\MemberAccountProvider;

class SecurityController
{
    public function login(Request $request): Response
    {
        $viewRenderer = new PhpViewRenderer(__DIR__ . '/../Resources/views/', __DIR__ . '/../Resources/views/layout.html.php');

        $session = new NativeSession();
        $session->start();

        $authenticationContext = new AuthenticationContext($session);

        if ($authenticationContext->isAccountLoggedIn()) {

            return new Response('Already logged-in !!');
        }

        if ($request->isPost()) {
            $email = $request->getRequest()->get('email');
            $password = $request->getRequest()->get('password');

            try {
                $accountAuthenticator = new AccountAuthenticator(
                    new MemberAccountProvider(new InMemoryMemberRepository()),
                    new PlainTextPasswordEncoder(),
                    $session
                );

                $accountAuthenticator->authenticate(new Email($email), $password);

            } catch (AuthenticationFailed $e) {

                return new Response($viewRenderer->render(
                    'loginFailed.html.php',
                    ['reason' => $e->getMessage()]
                ), 403);
            }

            return new Response($viewRenderer->render(
                'successfulLogin.html.php',
                ['email' => $authenticationContext->getAccount()->getEmail()]
            ));

        }

        return new Response($viewRenderer->render('login.html.php', [
            'email' => $email ?? '',
            'password' => $password ?? ''
        ]));
    }

    public function logout(Request $request): Response
    {
        $session = new NativeSession();
        $session->start();

        $authenticationContext = new AuthenticationContext($session);
        $authenticationContext->logout();

        return new Response('', 303, ['Location' => '/login']);
    }
}
