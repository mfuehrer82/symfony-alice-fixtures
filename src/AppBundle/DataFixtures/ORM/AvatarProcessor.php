<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Character;
use Nelmio\Alice\ProcessorInterface;
use Symfony\Component\Filesystem\Filesystem;

class AvatarProcessor implements ProcessorInterface
{
    /**
     * Processes an object before it is persisted to DB
     *
     * @param object $object instance to process
     */
    public function preProcess($object)
    {
        if (!$object instanceof Character) {
            return;
        }

        if (!$object->getAvatarFilename()) {
            return;
        }

        $projectRoot = __DIR__.'/../../../..';
        $fs = new Filesystem();
        $fs->copy(
            $projectRoot.'/resources/'.$object->getAvatarFilename(),
            $projectRoot.'/web/uploads/avatars/'.$object->getAvatarFilename(),
            true
        );
    }
    /**
     * Processes an object before it is persisted to DB
     *
     * @param object $object instance to process
     */
    public function postProcess($object)
    {
        // TODO: Implement postProcess() method.
    }
}