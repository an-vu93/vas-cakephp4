<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityLogs Model
 *
 * @method \App\Model\Entity\ActivityLog newEmptyEntity()
 * @method \App\Model\Entity\ActivityLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ActivityLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ActivityLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ActivityLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ActivityLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ActivityLogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('activity_logs');
        $this->setDisplayField('employee_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('employee_number')
            ->requirePresence('employee_number', 'create')
            ->notEmptyString('employee_number');

        $validator
            ->scalar('employee_name')
            ->maxLength('employee_name', 50)
            ->requirePresence('employee_name', 'create')
            ->notEmptyString('employee_name');

        $validator
            ->scalar('action')
            ->maxLength('action', 50)
            ->requirePresence('action', 'create')
            ->notEmptyString('action');

        $validator
            ->scalar('controller')
            ->maxLength('controller', 50)
            ->requirePresence('controller', 'create')
            ->notEmptyString('controller');

        $validator
            ->scalar('type')
            ->maxLength('type', 50)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('ip_address')
            ->maxLength('ip_address', 50)
            ->requirePresence('ip_address', 'create')
            ->notEmptyString('ip_address');

        return $validator;
    }
}
