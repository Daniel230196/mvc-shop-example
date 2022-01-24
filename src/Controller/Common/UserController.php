<?php

namespace MvcSkillet\Controller\Common;

use MvcSkillet\Component;
use MvcSkillet\Core\Exception\UserReadable\InvalidCredentials;
use MvcSkillet\Http;
use MvcSkillet\ServiceLocator;
use MvcSkillet\Component\Validation\Rules;

class UserController extends BaseCommonController {

    private Component\User\Facade $_userComponent;

    public function __construct(Http\Request $request, Http\Response $response, string $baseTemplatePath) {
        parent::__construct($request, $response, $baseTemplatePath);
        $this->_userComponent = ServiceLocator::userComponent();
    }

    public function end(): void {
        // TODO: Implement end() method.
    }

    public function default(): Http\Response {
        return $this->_response->setData('Not found')
            ->setStatus(404);
    }

    public function register() {
        $rules = [
            'login'                 => [new Rules\AnyString()],
            'password'              => [new Rules\AnyString()],
            'password_confirmation' => [new Rules\AnyString()],
            'email'                 => [new Rules\AnyString()],
            'phone'                 => [new Rules\AnyString()],
        ];

        $errors = $this->_validatorComponent->validateRequest($this->_request, $rules);

        $login                = $this->_request->post('login');
        $password             = $this->_request->post('password');
        $passwordConfirmation = $this->_request->post('password_confirmation');
        $email                = $this->_request->post('email');
        $phone                = $this->_request->post('phone');

        if(trim($password) !== trim($passwordConfirmation)) {
            $errors[] = 'Password mismatch';
        }

        /*try {
            $this->_userComponent->register($login, $password, $email, $phone);
        } catch {

        }
        return $this->generateHtmlResponse('page/main/registration.twig',[
            'errors' => [],
        ]);*/
//        return $this->_redirectResponse('page/main/index.twig');
        return $this->generateHtmlResponse('page/main/registration.twig');
    }

    public function login(): Http\Response {
        $rules = [
            'login'    => [new Rules\AnyString()],
            'password' => [new Rules\AnyString()],
        ];
        $errors   = $this->_validatorComponent->validateRequest($this->_request, $rules);
        $login    = $this->_request->post('login');
        $password = $this->_request->post('password');
        if (count($errors) > 0 || $login === null || $password === null) {
            return $this->generateHtmlResponse('page/main/login.twig', [
                'errors' => $errors,
            ], 401);
        }

        try {
            $this->_userComponent->login($login, $password);
            return $this->_redirectResponse('page/main/index.twig');
        } catch (InvalidCredentials $exception) {
            $errors[] = $exception->getMessage();
        }

        return $this->generateHtmlResponse('page/main/login.twig', ['errors' => ['Login or password is invalid']]);
    }

    protected function generateResponse() {

    }

    protected function _authorizeRequest() {
        // TODO: Implement _authorizeRequest() method.
    }
}