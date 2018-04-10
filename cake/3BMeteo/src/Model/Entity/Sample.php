<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sample Entity
 *
 * @property int $id
 * @property int $sensor_id
 * @property \Cake\I18n\FrozenTime $datetime
 * @property float $value
 *
 * @property \App\Model\Entity\Sensor $sensor
 */
class Sample extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'sensor_id' => true,
        'datetime' => true,
        'value' => true,
        'sensor' => true
    ];
}
