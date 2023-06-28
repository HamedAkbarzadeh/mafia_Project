<?php

namespace Database\Seeders;

use App\Models\Permission\Permission;
use App\Models\User\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*
        Permission
        ----------------
        Role	    Event	Mafia	Notify	User	Admin	Role	Permission	Set-role	Set-Permission	Setting	    Email	SMS	    Set-state-game	Set-user-state-game
        Developer	*	    *   	*   	*   	*   	*   	*   	    *        	*             	*   	    *   	*       *       	    *
        Owner	    *	    *   	*		RC		R			                                            *		                    *          	    *
        Admin	    C R U	C R U 	C R U							                                        R			                *	            *
        Author		C R U	C R U										                                                                *	            *
        Designer    R       R       R										                                *                           *	            *
        */
     DB::transaction(function() {
        $RoleCollect = collect([
            ['name' => 'developer', 'description' => 'Have a All Body Permission' , 'status' => 1] ,
            ['name' => 'owner' , 'description' => 'Rank 1' , 'status' => 1],
            ['name' => 'admin' , 'description' => 'Rank 2' , 'status' => 1],
            ['name' => 'author' , 'description' => 'Rank 3' , 'status' => 1],
            ['name' => 'designer' , 'description' => 'Rank 4' , 'status' => 1],
        ]);
        $RoleCollect->toArray();
        foreach($RoleCollect as $role){
            Role::create([
                'name' => $role['name'],
                'description' => $role['description'],
                'status' => $role['status'],
            ]);
        }

        $PermissionCollect = collect([

            //Event
            ['name' => 'create-event' , 'description' => 'you can create a events' , 'status' => 1],
            ['name' => 'read-event' , 'description' => 'you can read a events details' , 'status' => 1],
            ['name' => 'update-event' , 'description' => 'you can update a events details' , 'status' => 1],
            ['name' => 'delete-event' , 'description' => 'you can delete a events' , 'status' => 1],

            //Mafia Role
            ['name' => 'create-mafia' , 'description' => 'you can create a mafia Roles' , 'status' => 1],
            ['name' => 'read-mafia' , 'description' => 'you can reade a mafia Roles details' , 'status' => 1],
            ['name' => 'update-mafia' , 'description' => 'you can update a mafia Roles details' , 'status' => 1],
            ['name' => 'delete-mafia' , 'description' => 'you can delete a mafia Roles' , 'status' => 1],

            //Event Notification
            ['name' => 'create-notify' , 'description' => 'you can create a Notifications' , 'status' => 1],
            ['name' => 'read-notify' , 'description' => 'you can raed a Notifications details' , 'status' => 1],
            ['name' => 'update-notify' , 'description' => 'you can update a Notifications details' , 'status' => 1],
            ['name' => 'delete-notify' , 'description' => 'you can delete a Notifications' , 'status' => 1],

            //User Management
            ['name' => 'create-user' , 'description' => 'you can create a user' , 'status' => 1],
            ['name' => 'read-user' , 'description' => 'you can read a users' , 'status' => 1],
            ['name' => 'update-user' , 'description' => 'you can update a users details' , 'status' => 1],
            ['name' => 'delete-user' , 'description' => 'you can delete a users' , 'status' => 1],

            //Admin Management
            ['name' => 'create-admin' , 'description' => 'you can create a admin' , 'status' => 1],
            ['name' => 'read-admin' , 'description' => 'you can read a admins' , 'status' => 1],
            ['name' => 'update-admin' , 'description' => 'you can update a Admin details' , 'status' => 1],
            ['name' => 'delete-admin' , 'description' => 'you can delete a Admin(Account)' , 'status' => 1],

            //Role Management
            ['name' => 'create-role' , 'description' => 'you can create a Roles' , 'status' => 1],
            ['name' => 'read-role' , 'description' => 'you can read a Roles' , 'status' => 1],
            ['name' => 'update-role' , 'description' => 'you can update a Roles details' , 'status' => 1],
            ['name' => 'delete-role' , 'description' => 'you can delete a Roles' , 'status' => 1],

            //Permission Management
            ['name' => 'create-permission' , 'description' => 'you can create a permissions' , 'status' => 1],
            ['name' => 'read-permission' , 'description' => 'you can read a permissions details' , 'status' => 1],
            ['name' => 'update-permission' , 'description' => 'you can update a permissions details' , 'status' => 1],
            ['name' => 'delete-permission' , 'description' => 'you can delete a permissions' , 'status' => 1],

            //Set Role Management
            ['name' => 'create-set-role' , 'description' => 'you can set Role for Admin' , 'status' => 1],
            ['name' => 'read-set-role' , 'description' => 'you can read a Admin Roles ' , 'status' => 1],

            //Set Permission Management
            ['name' => 'create-set-permission' , 'description' => 'you can set Permissions for Admin' , 'status' => 1],
            ['name' => 'read-set-permission' , 'description' => 'you can read a Admin Permissions' , 'status' => 1],

            //setting Management
            ['name' => 'read-setting' , 'description' => 'you can read a setting details' , 'status' => 1],
            ['name' => 'update-setting' , 'description' => 'you can update a setting details' , 'status' => 1],

            //Email
            ['name' => 'create-email' , 'description' => 'you can create a Email for Send All User' , 'status' => 1],
            ['name' => 'read-email' , 'description' => 'you can read a Emails' , 'status' => 1],
            ['name' => 'update-email' , 'description' => 'you can Update a Email details' , 'status' => 1],
            ['name' => 'delete-email' , 'description' => 'you can delete a Email details' , 'status' => 1],

            //SMS
            ['name' => 'create-SMS' , 'description' => 'you can create a SMS for send all users' , 'status' => 1],
            ['name' => 'read-SMS' , 'description' => 'you can read a SMS details' , 'status' => 1],
            ['name' => 'update-SMS' , 'description' => 'you can update a SMS details' , 'status' => 1],
            ['name' => 'delete-SMS' , 'description' => 'you can delete a SMS' , 'status' => 1],

            //State Game
            ['name' => 'read-state-game' , 'description' => 'you can read a state game' , 'status' => 1],
            ['name' => 'update-state-game' , 'description' => 'you can update a state game' , 'status' => 1],

            //User State Game
            ['name' => 'read-user-state-game' , 'description' => 'you can read a user state in Game' , 'status' => 1],
            ['name' => 'update-user-state-game' , 'description' => 'you can update a user state in Game' , 'status' => 1],
            //Show Admin Panel
            ['name' => 'show-admin-panel' , 'description' => 'you can open Admin Panel' , 'status' => 1],

        ]);

        $PermissionCollect->toArray();

        foreach($PermissionCollect as $permission){
            Permission::create([
                'name' => $permission['name'],
                'description' => $permission['description'],
                'status' => $permission['status'],
            ]);
        }
     });

     DB::transaction(function () {
        $developer = Role::where('name' , 'developer')->first();
        $owner = Role::where('name' , 'owner')->first();
        $admin = Role::where('name' , 'admin')->first();
        $author = Role::where('name' , 'author')->first();
        $designer = Role::where('name' , 'designer')->first();

        $developerPermissions = Permission::all();

        foreach($developerPermissions as $permission){
            //develooper
            $developer->permissions()->attach($permission->id);

            //owner
            if(str_contains($permission->name , 'event') || str_contains($permission->name , 'show-admin-panel') || str_contains($permission->name , 'mafia') || str_contains($permission->name , 'notify') || str_contains($permission->name , 'read-user') || str_contains($permission->name , 'create-user') || str_contains($permission->name , 'read-admin') || str_contains($permission->name , 'setting') || str_contains($permission->name , 'create-user')  || str_contains($permission->name , 'state-game')){
                $owner->permissions()->attach($permission->id);
            }

            //admin
            if(str_contains($permission->name , 'create-event')  || str_contains($permission->name , 'show-admin-panel') || str_contains($permission->name , 'read-event') || str_contains($permission->name , 'update-event')
            || str_contains($permission->name , 'create-mafia') || str_contains($permission->name , 'read-mafia') || str_contains($permission->name , 'update-mafia')
            || str_contains($permission->name , 'create-notify') || str_contains($permission->name , 'read-notify') || str_contains($permission->name , 'update-notify')
            || str_contains($permission->name , 'setting') || str_contains($permission->name , 'state-game')){
                $admin->permissions()->attach($permission->id);
            }

            //author
            if(str_contains($permission->name , 'create-mafia') || str_contains($permission->name , 'show-admin-panel') || str_contains($permission->name , 'read-mafia') || str_contains($permission->name , 'update-mafia')
            || str_contains($permission->name , 'create-notify') || str_contains($permission->name , 'read-notify') || str_contains($permission->name , 'update-notify')
            || str_contains($permission->name , 'state-game')){
                $author->permissions()->attach($permission->id);
            }

            //designer
            if(str_contains($permission->name , 'read-mafia') || str_contains($permission->name , 'show-admin-panel') || str_contains($permission->name , 'read-notify')
            || str_contains($permission->name , 'setting')){
                $designer->permissions()->attach($permission->id);
            }
        }
     });

    }
}
