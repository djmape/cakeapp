<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HomeCarouselImgs Model
 *
 * @method \App\Model\Entity\HomeCarouselImg get($primaryKey, $options = [])
 * @method \App\Model\Entity\HomeCarouselImg newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HomeCarouselImg[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HomeCarouselImg|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HomeCarouselImg saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HomeCarouselImg patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HomeCarouselImg[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HomeCarouselImg findOrCreate($search, callable $callback = null, $options = [])
 */
class HomeCarouselImgsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('home_carousel_imgs');
        $this->setDisplayField('home_carousel_img_id');
        $this->setPrimaryKey('home_carousel_img_id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('home_carousel_img_id')
            ->allowEmptyString('home_carousel_img_id', 'create');

        $validator
            ->scalar('home_carousel_img_name')
            ->maxLength('home_carousel_img_name', 1000)
            ->requirePresence('home_carousel_img_name', 'create')
            ->allowEmptyString('home_carousel_img_name', false);

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        return $validator;
    }
}
