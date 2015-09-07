<?php

namespace TestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TestBundle\Entity\User;
/**
 * Fixtures de la entidad Usuario.
 * Crea 200 usuarios de prueba con información muy realista.
 */
class Users extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 40;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las ciudades de la base de datos
        $cities = $manager->getRepository('TestBundle:City')->findAll();

        for ($i=1; $i<=200; $i++) {
            $user = new User();

            $user->setName($this->getName());
            $user->setSurname($this->getSurname());
            $user->setEmail('user'.$i.'@localhost');

            $user->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));

            $passwordEnClaro = 'user'.$i;
            $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
            $passwordCodificado = $encoder->encodePassword($passwordEnClaro, $user->getSalt());
            $user->setPassword($passwordCodificado);

            $city = $cities[array_rand($cities)];
            $user->setAddress($this->getAddress($city));
            $user->setCity($city);

            // El 60% de los usuarios permite email
            $user->setEmailAllows((rand(1, 1000) % 10) < 6);

            $user->setDischargeDate(new \DateTime('now - '.rand(1, 150).' days'));
            $user->setBirthDate(new \DateTime('now - '.rand(7000, 20000).' days'));

            $dni = substr(rand(), 0, 8);
            $user->setDni($dni.substr("TRWAGMYFPDXBNJZSQVHLCKE", strtr($dni, "XYZ", "012")%23, 1));

            $user->setCreditNumber('1234567890123456');

            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * Generador aleatorio de nombres de personas.
     * Aproximadamente genera un 50% de hombres y un 50% de mujeres.
     *
     * @return string Nombre aleatorio generado para el usuario.
     */
    private function getName()
    {
        // Los nombres más populares en España según el INE
        // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm

        $men = array(
            'Antonio', 'José', 'Manuel', 'Francisco', 'Juan', 'David',
            'José Antonio', 'José Luis', 'Jesús', 'Javier', 'Francisco Javier',
            'Carlos', 'Daniel', 'Miguel', 'Rafael', 'Pedro', 'José Manuel',
            'Ángel', 'Alejandro', 'Miguel Ángel', 'José María', 'Fernando',
            'Luis', 'Sergio', 'Pablo', 'Jorge', 'Alberto'
        );
        $women = array(
            'María Carmen', 'María', 'Carmen', 'Josefa', 'Isabel', 'Ana María',
            'María Dolores', 'María Pilar', 'María Teresa', 'Ana', 'Francisca',
            'Laura', 'Antonia', 'Dolores', 'María Angeles', 'Cristina', 'Marta',
            'María José', 'María Isabel', 'Pilar', 'María Luisa', 'Concepción',
            'Lucía', 'Mercedes', 'Manuela', 'Elena', 'Rosa María'
        );

        if (rand() % 2) {
            return $men[array_rand($men)];
        } else {
            return $women[array_rand($women)];
        }
    }

    /**
     * Generador aleatorio de apellidos de personas.
     *
     * @return string Apellido aleatorio generado para el usuario.
     */
    private function getSurname()
    {
        // Los apellidos más populares en España según el INE
        // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm

        $surnames = array(
            'García', 'González', 'Rodríguez', 'Fernández', 'López', 'Martínez',
            'Sánchez', 'Pérez', 'Gómez', 'Martín', 'Jiménez', 'Ruiz',
            'Hernández', 'Díaz', 'Moreno', 'Álvarez', 'Muñoz', 'Romero',
            'Alonso', 'Gutiérrez', 'Navarro', 'Torres', 'Domínguez', 'Vázquez',
            'Ramos', 'Gil', 'Ramírez', 'Serrano', 'Blanco', 'Suárez', 'Molina',
            'Morales', 'Ortega', 'Delgado', 'Castro', 'Ortíz', 'Rubio', 'Marín',
            'Sanz', 'Iglesias', 'Nuñez', 'Medina', 'Garrido'
        );

        return $surnames[array_rand($surnames)].' '.$surnames[array_rand($surnames)];
    }

    /**
     * Generador aleatorio de direcciones postales.
     *
     * @param  City $city Objeto de la ciudad para la que se genera una dirección postal.
     * @return string         Dirección postal aleatoria generada para la tienda.
     */
    private function getAddress(City $city)
    {
        $prefixes = array('Calle', 'Avenida', 'Plaza');
        $names = array(
            'Lorem', 'Ipsum', 'Sitamet', 'Consectetur', 'Adipiscing',
            'Necsapien', 'Tincidunt', 'Facilisis', 'Nulla', 'Scelerisque',
            'Blandit', 'Ligula', 'Eget', 'Hendrerit', 'Malesuada', 'Enimsit'
        );

        return $prefixes[array_rand($prefixes)].' '.$names[array_rand($names)].', '.rand(1, 100)."\n"
               .$this->getPostalCode().' '.$city->getName();
    }

    /**
     * Generador aleatorio de códigos postales
     *
     * @return string Código postal aleatorio generado para la tienda.
     */
    private function getPostalCode()
    {
        return sprintf('%02s%03s', rand(1, 52), rand(0, 999));
    }
}
