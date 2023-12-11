<?php

namespace App\Service;

use App\Entity\UrlCodeEntity;
use App\Repository\UrlCodeEntityRepository;
use App\Shortener\Interfaces\InterfaceRepository;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface ;
use InvalidArgumentException;

class UrlConverterRepository implements InterfaceRepository
{
    /**
     * @var UrlCodeEntityRepository
     */
    protected ObjectRepository $repository;

    public function __construct(protected EntityManagerInterface  $em)
    {
        $this->repository = $em->getRepository(UrlCodeEntity::class);
    }

    public function saveAll(string $code, string $url): bool
    {
        try {
            $entity = new UrlCodeEntity($url, $code);
            $this->em->persist($entity);
            $this->em->flush();
            $result = true;
        }catch (\Throwable){
            $result = false;
        }
        return $result;
    }

    public function getUrl(string $code): string
    {
        $entity = $this->repository->findOneBy(['code' => $code]);
        if($entity){
            return $entity->getUrl();
        }else {
            throw new InvalidArgumentException("Не удалось разкодировать, такого Url в базе данных не существует.");
        }
    }

    public function getCode(string $url): string
    {
        $entity = $this->repository->findOneBy(['url' => $url]);
        return $entity->getCode();
    }

    public function checkUrlDatabase(string $url):mixed
    {
        return $this->repository->findOneBy(['url' => $url]);
    }
}