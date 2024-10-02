<?php

return [

    'audits_sort' => [
        'column' => 'created_at',
        'direction' => 'desc',
    ],

    'is_lazy' => true,

    /**
     *  Extending Columns
     * --------------------------------------------------------------------------
     *  In case you need to add a column to the AuditsRelationManager that does
     *  not already exist in the table, you can add it here, and it will be
     *  prepended to the table builder.
     */
    'audits_extend' => [
        'url' => [
            'class' => \Filament\Tables\Columns\TextColumn::class,
            'methods' => [
                'sortable',
                'searchable' => true,
                'default' => 'N/A'
            ]
        ],
    ],

    'custom_audits_view' => false,

    'custom_view_parameters' => [
    ],

    'mapping' => [
        'user_id' => [
            'model' => App\Models\User::class,
            'field' => 'name',
            'label' => 'User',
        ],
        'permission_id' => [
            'model' => App\Models\Permission::class,
            'field' => 'name',
            'label' => 'Permission',
        ],
        'role_id' => [
            'model' => App\Models\Role::class,
            'field' => 'name',
            'label' => 'Role',
        ],
    ],

];
