<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use Metinet\Core\Connexion\Connexion;
use Metinet\Core\Connexion\User;
use Metinet\Core\Connexion\UserCollection;
use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Core\Routing\RouteUrlMatcher;
use Metinet\Core\Routing\RouteNotFound;
use Metinet\Core\Config\JsonFileLoader;
use Metinet\Core\Config\ChainLoader;
use Metinet\Core\Controller\ControllerResolver;
use Metinet\Core\Config\Configuration;
use Metinet\Domain\Events\Salle;
use Metinet\Domain\Events\Event;
use Metinet\Domain\Events\ParticipantCollection;
use Metinet\Domain\Student;
use Metinet\Domain\Events\Participant;
use Metinet\Domain\DateOfBirth;

$request = Request::createFromGlobals();

$loader = new ChainLoader([
    new JsonFileLoader([__DIR__ . '/../conf/app.json']),
]);

$config = new Configuration($loader);

$logger = $config->getLogger();

try {
    $controllerResolver = new ControllerResolver(new RouteUrlMatcher($config->getRoutes()));
    $callableAction = $controllerResolver->resolve($request);
    $response = call_user_func($callableAction, $request);
} catch (RouteNotFound $e) {
    $logger->log($e->getMessage(), ['url' => $request->getPath()]);
    $response = new Response('Page not found', 404);
} catch (Throwable $e) {
    $logger->log($e->getMessage(), ['url' => $request->getPath()]);
    $response = new Response(sprintf('<p>Error: %s</p>', $e->getMessage()), 500);
}




/*
$Objectif = array(
    "Objectif 1",
    "Objectif 2",
    "Objectif 3"
);

$Salle = new Salle(15, 3, "Salle 1", "addresse");

$Etudiant1 = new Student("machin", "chose", DateOfBirth::fromString('2017-01-01'), 2016);
$Etudiant2 = new Student("bidule", "truc", DateOfBirth::fromString('2017-01-01'), 2016);

$Participant1 = new Participant('nom', 'prenom', 'test@test.com', false);
$Participant2 = new Participant($Etudiant1->getLastName(), $Etudiant1->getFirstName(), 'test@test.fr');
$Participant3 = new Participant($Etudiant2->getLastName(), $Etudiant2->getFirstName(), 'est@tt.fr');
$Participant4 = new Participant('bonjour', 'monsieur', 'test@test.fr', false, true);
$Participant5 = new Participant('bonhomme', 'enmousse', 'test@test.fr', false, true);


$ParticipantsCollection= new ParticipantCollection(array($Participant1, $Participant2, $Participant3, $Participant4 ));
$event = new Event('date', 'Description', $Objectif, $Salle, $ParticipantsCollection->all());
$eventPrivate = new Event('date', 'Description', $Objectif, $Salle, $ParticipantsCollection->all(), true);

$event->inscription($Participant5);
$event->toPay('est@tt.fr');
//$event->setPrivate();
//$eventPrivate->inscription($Participant5);

*/


$User1 = new User('email@email.fr', 'password1&');
$pass = "password3&";
$email = "email3@email.fr";
$User2 = new User($email, $pass);

$UserArray= array($User1, $User2);
$UserCollection = new UserCollection($UserArray);
$Connecteur = new Connexion($UserCollection->all());
//$email="emailAZ@email.fr";
$UserCollection->add($Connecteur->connectUser($email,$pass));

//var_dump($UserCollection);

$response->send();
