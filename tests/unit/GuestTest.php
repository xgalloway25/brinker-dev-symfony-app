<?php

namespace App\Tests;

use App\Controller\GuestController;
use App\Entity\Guest;
use App\Repository\GuestRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
// use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Twig\Environment;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GuestTest extends TestCase
{
    private $controller;
    private $guestRepository;
    private $entityManager;

    protected function setUp(): void
    {
        // self::bootKernel();

        $this->guestRepository = $this->createMock(GuestRepository::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $formFactory = $this->createMock(FormFactoryInterface::class);

        // Initialize controller with mocked dependencies
        $this->controller = new class($this->guestRepository, $this->entityManager, $formFactory) extends GuestController {
            protected function render(string $view, array $parameters = [], Response $response = null): Response
            {
                // Mock the render method to return a Response
                return new Response();
            }
        };

        // Use a reflection to set the container
        // $container = self::$kernel->getContainer();
        // $reflection = new \ReflectionClass(GuestController::class);
        // $property = $reflection->getProperty('container');
        // $property->setAccessible(true);
        // $property->setValue($this->controller, $container);
    }
    public function testIndexReturnsResponse()
    {
        // $twig = $this->createMock(Environment::class);
        // $twig->method('render')->willReturn('app_guest_index');

        $response = $this->controller->index($this->guestRepository);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        // $this->assertEquals('app_guest_index', $response->getContent());
    }
    public function testNew()
    {
        // $twig = $this->createMock(Environment::class);

        // $form = $this->createMock(FormInterface::class);
        // $form->method('handleRequest')->willReturnSelf();
        // $form->method('isSubmitted')->willReturn(true);
        // $form->method('isValid')->willReturn(true);
        // $form->method('createView')->willReturn('form_view');

        // $formFactory->method('create')->willReturn($form);
        $request = new Request();

        // $entityManager->expects($this->once())->method('persist')->with($this->isInstanceOf(Guest::class));
        // $entityManager->expects($this->once())->method('flush');

        // $response = $this->controller->new($request, $entityManager);

        // $this->assertInstanceOf(Response::class, $response);
        // $this->assertEquals(303, $response->getStatusCode());

        $response = $this->controller->new($request, $this->entityManager);

        $this->assertInstanceOf(Response::class, $response);
    }
    public function testShow()
    {
        $guest = new Guest();
        // $twig = $this->createMock(Environment::class);
        // $twig->method('render')->willReturn('rendered_template');

        // $this->assertInstanceOf(Response::class, $response);
        // $this->assertEquals('rendered_template', $response->getContent());

        $response = $this->controller->show($guest);

        $this->assertInstanceOf(Response::class, $response);
    }
    public function testEdit()
    {
        $guest = new Guest();
        // $twig = $this->createMock(Environment::class);

        // $form = $this->createMock(FormInterface::class);
        // $form->method('handleRequest')->willReturnSelf();
        // $form->method('isSubmitted')->willReturn(true);
        // $form->method('isValid')->willReturn(true);
        // $form->method('createView')->willReturn('form_view');

        // $formFactory->method('create')->willReturn($form);

        $request = new Request();

        // $entityManager->expects($this->once())->method('flush');

        // $response = $this->controller->edit($request, $guest, $entityManager);

        // $this->assertInstanceOf(Response::class, $response);
        // $this->assertEquals(303, $response->getStatusCode());

        $response = $this->controller->edit($request, $guest, $this->entityManager);

        $this->assertInstanceOf(Response::class, $response);
    }
    public function testDelete()
    {
        $guest = new Guest();
        // $csrfTokenManager = $this->createMock(CsrfTokenManagerInterface::class);
        // $security = $this->createMock(Security::class);

        // $csrfTokenManager->method('isTokenValid')->willReturn(true);

        // $user = $this->createMock(UserInterface::class);
        // $security->method('getUser')->willReturn($user);

        $request = new Request([], ['_token' => 'valid_token']);

        // $entityManager->expects($this->once())->method('remove')->with($guest);
        // $entityManager->expects($this->once())->method('flush');

        // $this->assertInstanceOf(Response::class, $response);
        // $this->assertEquals(303, $response->getStatusCode());

        $response = $this->controller->delete($request, $guest, $this->entityManager);

        $this->assertInstanceOf(Response::class, $response);
    }
}
