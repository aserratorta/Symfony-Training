
// app/config/routing.php
$collection->add('hello', new Route('/hello/{name}', array(
'_controller' => 'AcmeHelloBundle:Hello:index',
)));

