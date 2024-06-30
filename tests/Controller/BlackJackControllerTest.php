<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\BlackJackController;
use App\BlackJack\BlackJack;

class BlackJackControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('h1', 'Black Jack');
        $this->assertSelectorExists('a[href="https://github.com/racoontwo/mvc-vt24"]');
    }

    public function testPlayBlackJackRedirectsWhenNoGameInSession()
    {
        $client = static::createClient();

        // Simulate the request to the /game/play_black_jack route
        $client->request('GET', '/game/play_black_jack');

        // Assert that the response is a redirect to the /game/black_jack route
        $this->assertResponseRedirects('/game/black_jack');
    }

    // public function testHome()
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/game/black_jack');

    //     $this->assertResponseIsSuccessful();
    // }

    // public function testHomeSessionAccess()
    // {
    //     // Create a client to simulate a browser
    //     $client = static::createClient();

    //     // Request the /game/black_jack route to initialize the session
    //     // $client->request('GET', '/game/black_jack');
    //     $client->request('GET', '/game/black_jack_init');

    //     // Fetch the session from the request object
    //     $session = $client->getRequest()->getSession();

    //     // Check if the session is started
    //     // $this->assertTrue($session->isStarted());
    // }

    // public function testInitGameSessionNotExists()
    // {
    //     // Create mocks for dependencies
    //     $session = $this->createMock(SessionInterface::class);
    //     $router = $this->createMock(RouterInterface::class);

    //     // Create mocks for game components
    //     $deck = $this->createMock(DeckOfCards::class);
    //     $playerHand = $this->createMock(CardHand::class);
    //     $dealerHand = $this->createMock(CardHand::class);
    //     $card = $this->createMock(CardGraphic::class);

    //     // Setup the deck mock
    //     $deck->expects($this->once())
    //         ->method('shuffle');

    //     $deck->expects($this->once())
    //         ->method('drawCard')
    //         ->willReturn($card);

    //     $deck->expects($this->once())
    //         ->method('jsonDeckRaw')
    //         ->willReturn('{"deck": "data"}');

    //     // Setup the hand mocks
    //     $playerHand->expects($this->once())
    //         ->method('add')
    //         ->with($card);

    //     $playerHand->expects($this->once())
    //         ->method('getHandAsJson')
    //         ->willReturn('{"player_hand": "data"}');

    //     $dealerHand->expects($this->once())
    //         ->method('getHandAsJson')
    //         ->willReturn('{"dealer_hand": "data"}');

    //     // Setup session mock
    //     $session->expects($this->once())
    //         ->method('get')
    //         ->with('black_jack_game')
    //         ->willReturn(null);

    //     $session->expects($this->once())
    //         ->method('set')
    //         ->with('black_jack_game', [
    //             'deck' => '{"deck": "data"}',
    //             'player_hand' => '{"player_hand": "data"}',
    //             'dealer_hand' => '{"dealer_hand": "data"}'
    //         ]);

    //     // Setup router mock
    //     $router->expects($this->once())
    //         ->method('generate')
    //         ->with('play_black_jack')
    //         ->willReturn('/play_black_jack');

    //     // Instantiate the controller
    //     $controller = new BlackJackController($router);

    //     // Call the method and assert the response
    //     $response = $controller->init($session);
    //     $this->assertInstanceOf(RedirectResponse::class, $response);
    //     $this->assertEquals('/play_black_jack', $response->getTargetUrl());
    // }


    // public function testPlayBlackJackWithNoGameData()
    // {
    //     $client = static::createClient();
    //     $session = $client->getContainer()->get('session');

    //     // Ensure no game data in the session
    //     $session->remove('black_jack_game');
    //     $session->save();

    //     $client->request('GET', '/game/play_black_jack');
        
    //     $this->assertTrue($client->getResponse()->isRedirect());
    //     $this->assertEquals('/black_jack', $client->getResponse()->headers->get('Location'));
    // }

    // public function testPlayBlackJackWithGameData()
    // {
    //     $client = static::createClient();
    //     $session = $client->getContainer()->get('session');

    //     $game = new BlackJack();
    //     $gameData = $game->exportToJson();

    //     // Set game data in the session
    //     $session->set('black_jack_game', $gameData);
    //     $session->save();

    //     $crawler = $client->request('GET', '/game/play_black_jack');

    //     $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    //     $this->assertSelectorTextContains('html h1', 'Black Jack'); // Assuming there is an h1 element with 'Black Jack' in the template
    // }
}