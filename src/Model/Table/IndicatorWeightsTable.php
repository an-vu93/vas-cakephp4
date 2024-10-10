<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IndicatorWeights Model
 *
 * @property \App\Model\Table\AnalysesTable&\Cake\ORM\Association\BelongsTo $Analyses
 * @property \App\Model\Table\IndicatorsTable&\Cake\ORM\Association\BelongsTo $Indicators
 *
 * @method \App\Model\Entity\IndicatorWeight newEmptyEntity()
 * @method \App\Model\Entity\IndicatorWeight newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\IndicatorWeight[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IndicatorWeight get($primaryKey, $options = [])
 * @method \App\Model\Entity\IndicatorWeight findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\IndicatorWeight patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IndicatorWeight[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\IndicatorWeight|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IndicatorWeight saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IndicatorWeight[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\IndicatorWeight[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\IndicatorWeight[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\IndicatorWeight[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class IndicatorWeightsTable extends Table
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

        $this->setTable('indicator_weights');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Analyses', [
            'foreignKey' => 'analysis_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Indicators', [
            'foreignKey' => 'indicator_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('analysis_id')
            ->notEmptyString('analysis_id');

        $validator
            ->integer('indicator_id')
            ->notEmptyString('indicator_id');

        $validator
            ->integer('weight')
            ->requirePresence('weight', 'create')
            ->notEmptyString('weight');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('analysis_id', 'Analyses'), ['errorField' => 'analysis_id']);
        $rules->add($rules->existsIn('indicator_id', 'Indicators'), ['errorField' => 'indicator_id']);

        return $rules;
    }
}
