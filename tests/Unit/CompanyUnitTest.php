<?php

namespace Tests\Unit;

use App\Company;
use App\Http\Controllers\CompaniesController;
use Illuminate\Http\Request;
use Tests\TestCase;
//use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CompanyUnitTest extends TestCase
{

    use RefreshDatabase;

    public function testCompaniesDatabaseTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('companies', [
              'name',
              'email',
              'logo',
              'website'
            ]), 1);

    }

    /**
     * Tests creating a company's db record.
     *
     * @return void
     */
    public function testCompanyCRUDtest()
    {
        $data = [
            'name' => 'testcompany',
            'email' => 'test@company.com',
            'logo' => 'public/storage/logos/usp.png',
            'website' => 'www.testcompany.com'
        ];

        $data_new = [
          'name' => 'newtestcompany',
          'email' => 'newtest@company.com',
          'logo' => 'public/storage/logos/newusp.png',
          'website' => 'www.newtestcompany.com'
        ];

        $company = new Company;
        $company->name = $data['name'];
        $company->email = $data['email'];
        $company->logo = $data['logo'];
        $company->website = $data['website'];
        $company->save();

        //testing that data is stored
        $this->assertTrue($company->save());

        $company_fetched = $company->all()->where('name',  '=', $data['name']);

        //testing that data is coming returned
        $this->assertNotNull($company_fetched);

        //testing that the right data is returned
        $this->assertEquals($company_fetched->first()->value('name'), $data['name']);
        $this->assertEquals($company_fetched->first()->value('email'), $data['email']);
        $this->assertEquals($company_fetched->first()->value('logo'), $data['logo']);
        $this->assertEquals($company_fetched->first()->value('website'), $data['website']);


        //testing that data can be updated
        $company_to_update = $company->all()->first();
        $company_to_update->name = $data_new['name'];
        $company_to_update->email = $data_new['email'];
        $company_to_update->logo = $data_new['logo'];
        $company_to_update->website = $data_new['website'];
        $company_to_update->save();

        $company_updated = $company->all()->where('name', '=', $data_new['name']);

        //testing that data is coming returned
        $this->assertNotNull($company_updated);

        $this->assertEquals($company_updated->first()->value('name'), $data_new['name']);
        $this->assertEquals($company_updated->first()->value('email'), $data_new['email']);
        $this->assertEquals($company_updated->first()->value('logo'), $data_new['logo']);
        $this->assertEquals($company_updated->first()->value('website'), $data_new['website']);

        //check that old record isnt there anymore
        $old = $company->all()->where('name',  '=', $data['name']);
        $this->assertEmpty($old);

        //testing that record can be deleted
        $retrieved_company = $company->all()->first();
        $retrieved_company->delete();
        $this->assertNull($company->all()->first());

    }


}
