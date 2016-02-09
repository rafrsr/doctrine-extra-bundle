# Timestampable

Automatically add **created** and **updated** timestamps fields for your entities.

````php

use Rafrsr\DoctrineExtraBundle\Model\TimestampableInterface
use Rafrsr\DoctrineExtraBundle\Model\TimestampableTrait;

class Transaction implements TimestampableInterface {
    
    use TimestampableTrait;
}

````