<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 25/01/18
 * Time: 13:53
 */

namespace App\DataFixtures\ORM;


use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    /**
     * @var int
     */
    private const POSTS_COUNT = 50;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        for ($i = 0; $i < self::POSTS_COUNT; $i++) {
            $post = new Post();
            $post->setAuthor('Author' . $i)
                ->setTitle('Title ' . $i)
                ->setText('Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Sed ut ornare sem. Sed ac metus risus. Praesent non lorem 
                                sit amet massa viverra finibus at eu nisl. Morbi risus justo, 
                                ultrices nec dui non, porttitor sodales ipsum. Sed rhoncus, 
                                dui ac aliquet tempor, arcu mi vestibulum nulla, et interdum 
                                ligula est in magna. Morbi blandit maximus interdum. Pellentesque 
                                tincidunt vehicula risus, ac lobortis mi venenatis vitae. 
                                Ut et purus tincidunt metus dapibus porttitor non ut odio. 
                                Suspendisse lobortis nisl sed felis vestibulum ullamcorper. 
                                Donec malesuada velit vitae eleifend luctus. Quisque ut ex pharetra turpis 
                                condimentum feugiat. Morbi sed pulvinar ex. Integer molestie non eros et laoreet. 
                                Pellentesque et feugiat purus. Duis vulputate pharetra dui gravida dictum. 
                                Suspendisse potenti.');

            $manager->persist($post);
        }

        $manager->flush();
    }
}