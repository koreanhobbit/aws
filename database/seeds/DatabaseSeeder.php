<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(blogcategoriesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(profilesocialmediasTableSeeder::class);
        $this->call(profileattributesTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(WebSocialMediaTableSeeder::class);
        $this->call(PortfolioCategoriesTableSeeder::class);
        $this->call(RoleSeederTable::class);
        $this->call(PivotUserRoleSeeder::class);
        $this->call(pivotprofileattributes::class);
        $this->call(pivotprofilesosmed::class);
        $this->call(imageableseeder::class);
        $this->call(teamprofileseeder::class);
        $this->call(CreateProductCategorySeeder::class);
        $this->call(parameterProductSeeder::class);
        $this->call(ThumbnailSeeder::class);
        $this->call(ImageMidSeeder::class);
    }
}
