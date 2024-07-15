<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Response;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Controller\BlackJackController;
use App\BlackJack\BlackJack;
use App\Card\CardHand;
use App\Card\DeckOfCards;

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

    public function testHitMe()
    {
        $client = static::createClient();

        $client->request('GET', '/game/hit_me');

        // Assert that the response is a redirect to the /game/black_jack route
        $this->assertResponseRedirects('/game/black_jack');
    }
}
