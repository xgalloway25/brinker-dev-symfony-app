<?php

namespace App\Tests\Functional;

use Symfony\Component\Panther\PantherTestCase;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Guest;
use App\Entity\User;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use App\DataFixtures\AppFixtures;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\Loader;

class GuestTest extends PantherTestCase
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;
    // private Session $session;

    public function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        // Get the password hasher service
        $this->passwordHasher = self::$kernel->getContainer()
        ->get(UserPasswordHasherInterface::class);
        
        // Purge the database
        $purger = new ORMPurger($this->entityManager);
        $executor = new ORMExecutor($this->entityManager, $purger);
        $executor->purge();

        // Load fixtures
        $loader = new Loader();
        $loader->addFixture(new AppFixtures($this->passwordHasher));
        
        $executor->execute($loader->getFixtures());
    }

    # Checks that the home page is accessible to guests by returning a successful response
    public function testGuestHomePage(){
        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);
        $this->assertNotNull($user, 'User entity should exist in the database for this test.');

        $guest = $this->entityManager->getRepository(Guest::class)->findOneBy([]);
        $this->assertNotNull($guest, 'Guest entity should exist in the database for this test.');

        $client = static::createClient();
        $crawler = $client->request('GET', '/guest/');
        $this->assertResponseIsSuccessful();
        // assert that the user references the guest
        $this->assertEquals($user->getGuestId()->getId(), $guest->getId());
    }

    // # Checks that the guest profile page is accessible by returning a successful response
    public function testGuestProfilePage(){
        // Ensure there's at least one Guest entity in the database
        $guest = $this->entityManager->getRepository(Guest::class)->findOneBy([]);
        $this->assertNotNull($guest, 'Guest entity should exist in the database for this test.');

        $client = static::createClient();
        $crawler = $client->request('GET', '/guest/' . $guest->getId());
        $this->assertResponseIsSuccessful();
    }

    # test that the update form edits the profile in the database
    public function testUpdateProfile(){
        $guest = $this->entityManager->getRepository(Guest::class)->findOneBy([]);
        $this->assertNotNull($guest, 'Guest entity should exist in the database for this test.');

        $client = static::createClient();
        $crawler = $client->request('GET', '/guest/' . $guest->getId() . '/edit');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Update')->form([
            'guest[first_name]' => 'Jane',
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/guest/');
        $client->followRedirect();

        // Re-fetch the guest entity from the database
        $updatedGuest = $this->entityManager->getRepository(Guest::class)->find($guest->getId());
        $this->assertEquals('Jane', $updatedGuest->getFirstName());
    }

    # test that the delete form deletes the profile in the database
    public function testDeleteProfile(){
        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);
        $this->assertNotNull($user, 'User entity should exist in the database for this test.');
        $guest = $this->entityManager->getRepository(Guest::class)->findOneBy([]);
        $this->assertNotNull($guest, 'Guest entity should exist in the database for this test.');

        $client = static::createClient();
        $client->loginUser($user);

        // Check that the user is authenticated
        $this->assertNotNull($client->getContainer()->get('security.token_storage')->getToken()->getUser(), 'User should be authenticated.');

        $crawler = $client->request('GET', '/guest/' . $guest->getId());
        $this->assertResponseIsSuccessful();
        $form = $crawler->selectButton('Delete')->form();
        $client->submit($form);
        $this->assertResponseRedirects('/guest/');
        $client->followRedirect();
        $this->assertNull($this->entityManager->getRepository(Guest::class)->findOneBy(['id' => $guest->getId()]));
        $this->assertNull($this->entityManager->getRepository(User::class)->findOneBy(['id' => $guest->getId()]));
    }

    protected function tearDown(): void
    {
        // Close and clear the EntityManager
        if ($this->entityManager !== null) {
            $this->entityManager->close();
            $this->entityManager->clear();
        }
        parent::tearDown();
    }
}
