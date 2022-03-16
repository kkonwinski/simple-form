<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subjectNames = [
            "Duis tempus ut felis eu pulvinar.",
            "Integer tristique ultrices sapien.",
            "Fusce fermentum egestas dui in consectetur.",
            "Donec molestie efficitur blandit.",
            "Sed feugiat tincidunt augue nec laoreet"
        ];
        foreach ($subjectNames as $subjectName) {
            $subject = new Subject();
            $subject->setName($subjectName);
            $manager->persist($subject);
        }

        $manager->flush();
    }
}
