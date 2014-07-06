<?php

/*
 * This file is part of Trident.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\TestModule\Controller;

use Trident\Component\HttpKernel\Exception\ForbiddenHttpException;
use Trident\Component\HttpKernel\Exception\NotFoundHttpException;
use Trident\Module\FrameworkModule\Controller\Controller;

use SeerUK\Module\TestModule\Security\Authentication\Token\TestUserToken;

/**
 * Test Controller
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class TestController extends Controller
{
    public function testAction()
    {
        $security = $this->get('security');

        $token = new TestUserToken([
            'username' => 'Seer',
            'password' => 'Test'
        ]);

        $result = $security->authenticate($token);

        $repo = $this->get('test.repository.user');
        $repo->setCachingProxy($this->get('caching.proxy'));

        if ( ! $security->isGranted('READ', $repo)) {
            throw new ForbiddenHttpException('You\'re not allowed to read that repository.');
        }

        $users = $repo->findAll();

        return $this->render('SeerUKTestModule:Test:index.html.twig', [
            'name' => count($users)
        ]);
    }

    public function variableAction($name)
    {
        if (true) {
            throw new NotFoundHttpException("No $name was found.");
        }

        return $this->render('SeerUKTestModule:Test:index.html.twig', [
            'name' => $name
        ]);
    }
}
