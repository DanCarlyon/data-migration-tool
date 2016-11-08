<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Migration\Step\DataIntegrity\Model;

use Magento\Framework\ObjectManagerInterface;
use Migration\ResourceModel\Adapter\Mysql as Adapter;

/**
 * Factory class for @see ForeignKey
 */
class ForeignKeyFactory
{
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $instanceName;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $instanceName = '\\Migration\\Step\\DataIntegrity\\Model\\ForeignKey'
    ) {
        $this->objectManager = $objectManager;
        $this->instanceName = $instanceName;
    }

    /**
     * @param Adapter $adapter
     * @param array $keyData data array with description of table foreign key, like one returned by
     * @see \Magento\Framework\DB\Adapter\Pdo\Mysql::getForeignKeys
     * @return ForeignKey
     */
    public function create(Adapter $adapter, $keyData)
    {
        return $this->objectManager->create(
            $this->instanceName,
            [
                'adapter' => $adapter,
                'keyName' => $keyData['FK_NAME'],
                'parentTable' => $keyData['REF_TABLE_NAME'],
                'childTable' => $keyData['TABLE_NAME'],
                'parentTableKey' => $keyData['REF_COLUMN_NAME'],
                'childTableKey' => $keyData['COLUMN_NAME']
            ]
        );
    }
}
