<?php

namespace App\Repository;


use App\Entity\TodosList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TodolistRepository extends ServiceEntityRepository
{ public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, TodosList::class);
    }
}