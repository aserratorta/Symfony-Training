
// src/Acme/HelloBundle/Controller/HelloController.php

// ...
class HelloController
{
public function indexAction($name)
{
return new Response('<html><body>Hello '.$name.'!</body></html>');
}
}

