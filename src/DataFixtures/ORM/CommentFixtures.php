<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 29/01/18
 * Time: 19:32
 */

namespace App\DataFixtures\ORM;


use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load(ObjectManager $manager) {
        $comment = new Comment();
        $comment->setAuthor('Eugene')
            ->setText('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ultricies lacus in suscipit venenatis. Aliquam erat volutpat. Vivamus eu erat ut ante dictum suscipit. Nunc vel tristique lacus, et blandit enim. Vivamus fringilla nibh a varius placerat. Vivamus interdum risus sed velit tempus, at vehicula quam pellentesque. Donec varius ornare tristique. In sed sem quis nisl pharetra mollis. Vivamus nec arcu purus. Fusce ut lorem ultricies, venenatis sapien eu, suscipit metus.');

        $manager->persist($comment);
        $this->addReference('comment', $comment);
    }
}