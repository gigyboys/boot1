<?php

namespace COM\ForumBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends EntityRepository
{
	public function getLastMessageByTopicId($topic_id){
		$query = $this->_em->createQuery('SELECT m FROM COMForumBundle:Message m JOIN m.subject s JOIN s.topic t WHERE t.id = :id ORDER BY m.id DESC');
		$query->setParameter('id', $topic_id);
		$query->setMaxResults(1);
		$message = $query->getOneOrNullResult();
		return $message;
	}
}
