<?php
declare(strict_types=1);

namespace App\EntityListenerz;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Article::class)]
class ArticleEntityListener
{   
    //достаем пользователя
    //в конструкторе передаем объект security и чтобы он был property, был доступен внутри класса
    public function __construct(private readonly Security $security) 
    {
    }


    public function prePersist(prePersistEventArgs $event): void
    {
        /** @var Article $entity */
        $entity = $event->getObject();
        //при сохранении entity добавляется дата создания, текущее время
        $entity->setCreatedAt(new \DateTimeImmutable());
        //хотим установить автора как security->getUser()
        $entity->setAuthor($this->security->getUser());
    }
}