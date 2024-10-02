<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'permission_access', 'description' => 'Can access permissions page'],
            ['name' => 'permission_create', 'description' => 'Can create new permission'],
            ['name' => 'permission_show', 'description' => 'Can view a permission'],
            ['name' => 'permission_edit', 'description' => 'Can edit and update a permission'],
            ['name' => 'permission_delete', 'description' => 'Can delete a permission'],
            ['name' => 'role_access', 'description' => 'Can access roles page'],
            ['name' => 'role_create', 'description' => 'Can create new role'],
            ['name' => 'role_show', 'description' => 'Can view a role'],
            ['name' => 'role_edit', 'description' => 'Can edit and update a role'],
            ['name' => 'role_delete', 'description' => 'Can delete a role'],
            ['name' => 'user_access', 'description' => 'Can access users page'],
            ['name' => 'user_create', 'description' => 'Can create new user'],
            ['name' => 'user_show', 'description' => 'Can view a user'],
            ['name' => 'user_edit', 'description' => 'Can edit and update a user'],
            ['name' => 'user_delete', 'description' => 'Can delete a user'],
            ['name' => 'pump_owner_access', 'description' => 'Can access pump owners page'],
            ['name' => 'pump_owner_create', 'description' => 'Can create new pump owner'],
            ['name' => 'pump_owner_show', 'description' => 'Can view a pump owner'],
            ['name' => 'pump_owner_edit', 'description' => 'Can edit and update a pump owner'],
            ['name' => 'pump_owner_delete', 'description' => 'Can delete a pump owner'],
            ['name' => 'pump_detail_access', 'description' => 'Can access pump details page'],
            ['name' => 'pump_detail_create', 'description' => 'Can create new pump detail'],
            ['name' => 'pump_detail_show', 'description' => 'Can view a pump detail'],
            ['name' => 'pump_detail_edit', 'description' => 'Can edit and update a pump detail'],
            ['name' => 'pump_detail_delete', 'description' => 'Can delete a pump detail'],
            ['name' => 'pump_type_access', 'description' => 'Can access pump types page'],
            ['name' => 'pump_type_create', 'description' => 'Can create new pump type'],
            ['name' => 'pump_type_show', 'description' => 'Can view a pump type'],
            ['name' => 'pump_type_edit', 'description' => 'Can edit and update a pump type'],
            ['name' => 'pump_type_delete', 'description' => 'Can delete a pump type'],
            ['name' => 'compartment_access', 'description' => 'Can access compartments page'],
            ['name' => 'compartment_create', 'description' => 'Can create new compartment'],
            ['name' => 'compartment_show', 'description' => 'Can view a compartment'],
            ['name' => 'compartment_edit', 'description' => 'Can edit and update a compartment'],
            ['name' => 'compartment_delete', 'description' => 'Can delete a compartment'],
            ['name' => 'volume_access', 'description' => 'Can access volumes page'],
            ['name' => 'volume_create', 'description' => 'Can create new volume'],
            ['name' => 'volume_show', 'description' => 'Can view a volume'],
            ['name' => 'volume_edit', 'description' => 'Can edit and update a volume'],
            ['name' => 'volume_delete', 'description' => 'Can delete a volume'],
            ['name' => 'truck_identification_access', 'description' => 'Can access truck identifications page'],
            ['name' => 'truck_identification_create', 'description' => 'Can create new truck identification'],
            ['name' => 'truck_identification_show', 'description' => 'Can view a truck identification'],
            ['name' => 'truck_identification_edit', 'description' => 'Can edit and update a truck identification'],
            ['name' => 'truck_identification_delete', 'description' => 'Can delete a truck identification'],
            ['name' => 'truck_owner_access', 'description' => 'Can access truck owners page'],
            ['name' => 'truck_owner_create', 'description' => 'Can create new truck owner'],
            ['name' => 'truck_owner_show', 'description' => 'Can view a truck owner'],
            ['name' => 'truck_owner_edit', 'description' => 'Can edit and update a truck owner'],
            ['name' => 'truck_owner_delete', 'description' => 'Can delete a truck owner'],
            ['name' => 'pump_calibration_access', 'description' => 'Can access pump calibrations page'],
            ['name' => 'pump_calibration_create', 'description' => 'Can create new pump calibration'],
            ['name' => 'pump_calibration_show', 'description' => 'Can view a pump calibration'],
            ['name' => 'pump_calibration_edit', 'description' => 'Can edit and update a pump calibration'],
            ['name' => 'pump_calibration_delete', 'description' => 'Can delete a pump calibration'],
            ['name' => 'pump_calibration_measure_detail_access', 'description' => 'Can access pump calibration measure details page'],
            ['name' => 'pump_calibration_measure_detail_create', 'description' => 'Can create new pump calibration measure detail'],
            ['name' => 'pump_calibration_measure_detail_show', 'description' => 'Can view a pump calibration measure detail'],
            ['name' => 'pump_calibration_measure_detail_edit', 'description' => 'Can edit and update a pump calibration measure detail'],
            ['name' => 'pump_calibration_measure_detail_delete', 'description' => 'Can delete a pump calibration measure detail'],
            ['name' => 'pump_calibration_totaliser_reading_access', 'description' => 'Can access pump calibration totaliser readings page'],
            ['name' => 'pump_calibration_totaliser_reading_create', 'description' => 'Can create new pump calibration totaliser reading'],
            ['name' => 'pump_calibration_totaliser_reading_show', 'description' => 'Can view a pump calibration totaliser reading'],
            ['name' => 'pump_calibration_totaliser_reading_edit', 'description' => 'Can edit and update a pump calibration totaliser reading'],
            ['name' => 'pump_calibration_totaliser_reading_delete', 'description' => 'Can delete a pump calibration totaliser reading'],
            ['name' => 'certificate_access', 'description' => 'Can access certificates page'],
            ['name' => 'certificate_create', 'description' => 'Can create new certificate'],
            ['name' => 'certificate_show', 'description' => 'Can view a certificate'],
            ['name' => 'certificate_edit', 'description' => 'Can edit and update a certificate'],
            ['name' => 'certificate_delete', 'description' => 'Can delete a certificate'],
            ['name' => 'signature_pad_access', 'description' => 'Can access a signature pad on calibrations']
        ];
        foreach ($permissions as $permission) {
            Permission::query()->firstOrCreate($permission, $permission);
        }
    }
}
