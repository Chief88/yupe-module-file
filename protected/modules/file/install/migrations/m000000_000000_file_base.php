<?php

class m000000_000000_file_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{file_file}}',
            array(
                'id'            => 'pk',
                'name'          => 'varchar(255) NOT NULL',
                'file'          => 'varchar(255) NOT NULL',
                'image'         => 'varchar(255) DEFAULT NULL',
                'icon'          => 'varchar(255) NOT NULL',
                'slug'          => 'varchar(255) NOT NULL',
                'category_id'   => 'integer DEFAULT NULL',
                'sort'          => "integer NOT NULL DEFAULT '1'"
            ),
            $this->getOptions()
        );

    }
 
    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys("{{file_file}}");
    }
}