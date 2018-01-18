<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Controllers;


use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Templating\PhpViewRenderer;
use Metinet\Domain\Conferences\Conference;
use Metinet\Domain\Conferences\ConferenceDetails;
use Metinet\Domain\Conferences\Date;
use Metinet\Domain\Conferences\Location;
use Metinet\Domain\Conferences\PostalAddress;
use Metinet\Domain\Conferences\Price;
use Metinet\Domain\Conferences\RegistrationRule;
use Metinet\Domain\Conferences\Time;
use Metinet\Domain\Conferences\TimeSlot;

class ConferencesController
{
    public function viewConferences(Request $request): Response
    {
        $conferences = [];
        $conferences[] = Conference::submit(
            new ConferenceDetails(
                'La programmation object',
                'Qu\'est-ce que la programmation ?',
                ['Apprendre à modéliser un concept', 'Comprendre l\'encapsulation']
            ),
            Date::fromAtomFormat('2018-01-31'),
            new TimeSlot(Time::fromString('13:00'), Time::fromString('13:30')),
            new Location('Amphi demi-lune', new PostalAddress('7, rue Peter Fink', '01000', 'Bourg-en-Bresse', 'France')),
            50,
            RegistrationRule::allowExternalPeopleToRegisterToConference(Price::inLowestSubunit(1000, 'EUR'))
        );

        $viewRenderer = new PhpViewRenderer(__DIR__ . '/../Resources/views/', __DIR__ . '/../Resources/views/layout.html.php');

        return new Response($viewRenderer->render('conferences.html.php', ['conferences' => $conferences]));
    }

    public function submitNewConference(Request $request): Response
    {
        $conference = Conference::submit(
            new ConferenceDetails(
                'La programmation object',
                'Qu\'est-ce que la programmation ?',
                ['Apprendre à modéliser un concept', 'Comprendre l\'encapsulation']
            ),
            Date::fromAtomFormat('2018-01-31'),
            new TimeSlot(Time::fromString('13:00'), Time::fromString('13:30')),
            new Location('Amphi demi-lune', new PostalAddress('7, rue Peter Fink', '01000', 'Bourg-en-Bresse', 'France')),
            50,
            RegistrationRule::allowExternalPeopleToRegisterToConference(Price::inLowestSubunit(1000, 'EUR'))
        );

        $conferences[$conference->getId()] = $conference;
        file_put_contents('conference-'.$conference->getId().'.txt', serialize($conference));
        $sql = 'INSERT INTO conferences (id, title, date) VALUES ('.$conference->getId().')';
    }
}
















