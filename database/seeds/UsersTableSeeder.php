<?php


use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'adviser']);

        $admin = User::create([
           'dni'=>'99999999',
           'password' => Hash::make('99999999'),
           'name'=>'admin'
       ]);

       $adviser = User::create([
        'dni'=>'22222222',
        'password' => Hash::make('22222222'),
        'name'=>'adviser'
    ]);

        $admin->assignRole('admin');
        $adviser->assignRole('adviser');

    }

    function users()
    {
        factory(App\User::class, 20)->create(
            [
                'password' => bcrypt('asdf1234')
            ]
        );

        $admin = Role::create(['name' => 'admin']);
        $teacher = Role::create(['name' => 'teacher']);
        $student = Role::create(['name' => 'student']);
        $adviser = Role::create(['name' => 'adviser']);

        $user = User::find(1);
        $user->assignRole($admin);

       for ($i=2; $i <=8 ; $i++) {
            $user = User::find($i);
            $user->assignRole($teacher);

       }


       for ($i=9; $i <=20 ; $i++) {
            $user = User::find($i);
            $user->assignRole($student);

        }



    }





}
