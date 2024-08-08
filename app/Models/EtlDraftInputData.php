<?php

namespace App\Models;

class EtlDraftInputData extends AbstractModel
{


    /**
     * @param array $draftData
     * @return array
     */
    public static function makeCollectionFromDraftData(array $draftData): array
    {

        if (!isset($draftData[0][0])) {
            return [];
        }

        // позже, можно будет доработать, и использовать этот массив для реализации защиты от изменения порядка колонок
        $attributesTemplate = [
            0 =>  ['source_name' => 'id',                    'attribute_name' => 'estate_code'],
            1 =>  ['source_name' => 'Агенство Недвижимости', 'attribute_name' => 'agency_code'],
            2 =>  ['source_name' => 'Менеджер',              'attribute_name' => 'manager_code'],
            3 =>  ['source_name' => 'Продавец',              'attribute_name' => 'contact_name'],
            4 =>  ['source_name' => 'Телефоны продавца',     'attribute_name' => 'contact_phone'],
            5 =>  ['source_name' => 'Цена',                  'attribute_name' => 'estate_price'],
            6 =>  ['source_name' => 'Описание',              'attribute_name' => 'estate_description'],
            7 =>  ['source_name' => 'Адрес',                 'attribute_name' => 'estate_address'],
            8 =>  ['source_name' => 'Этаж',                  'attribute_name' => 'estate_floor'],
            9 =>  ['source_name' => 'Этажей',                'attribute_name' => 'estate_house_floor'],
            10 => ['source_name' => 'Комнат',                'attribute_name' => 'estate_rooms']
        ];

        $forInsertArray = [];


        foreach ($draftData as $draftDatumKey => $draftDatum) {

            //пропускаем строку заголовков
            if ($draftDatumKey === 0) {
                continue;
            }

            $currentRow = [];
            foreach ($attributesTemplate as $attributeKey => $attribute) {
                $currentRow[$attribute['attribute_name']] = $draftDatum[$attributeKey];
            }

            $forInsertArray[] = $currentRow;

        }

        return $forInsertArray;
    }
    
}